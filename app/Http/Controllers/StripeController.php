<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\UserPayment;
use Stripe;

class StripeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $user = auth()->user();
        
        // Check if user has an active subscription
        if ($user->stripe_subscription_id) {
            try {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $subscription = \Stripe\Subscription::retrieve($user->stripe_subscription_id);
                if ($subscription->status === 'active' || $subscription->status === 'trialing') {
                    return redirect()->route('dashboard')->with('info', 'You already have an active subscription.');
                }
            } catch (\Exception $e) {
                // Subscription doesn't exist, clear the reference
                $user->stripe_subscription_id = null;
                $user->save();
            }
        }
        
        // Define available plans
        $plans = [
            'basic' => [
                'name' => 'basic',
                'price' => 599, // $5.99
                'description' => 'Basic Plan - Limited Albums',
                'features' => ['Up to 10 Albums', 'Basic Features', 'Email Support']
            ],
            'premium' => [
                'name' => 'premium',
                'price' => 999, // $9.99
                'description' => 'Premium Plan - Unlimited Albums',
                'features' => ['Unlimited Albums', 'All Premium Features', 'Priority Support']
            ]
        ];
        
        return view('admin.album.stripe.stripe_selection', compact('plans', 'user'));
    }
    
    public function subscribeToPlan(Request $request)
    {
        $user = auth()->user();
        $planType = $request->input('plan'); // 'basic' or 'premium'
        
        // Define plan details
        $planDetails = [
            'basic' => [
                'name' => 'basic',
                'price' => 599, // $5.99 in cents
                'description' => 'Basic Plan - 1 Album',
                'features' => ['1 Album', 'Basic Features', 'Limited Storage']
            ],
            'premium' => [
                'name' => 'premium', 
                'price' => 999, // $9.99 in cents
                'description' => 'Premium Plan - Unlimited Albums',
                'features' => ['Unlimited Albums', 'All Premium Features', 'Priority Support']
            ]
        ];
        
        if (!isset($planDetails[$planType])) {
            return redirect()->back()->with('error', 'Invalid plan selected.');
        }
        
        $plan = $planDetails[$planType];
        
        // Store the selected plan in session for the stripe form
        session(['selected_plan' => $plan]);
        
        return redirect()->route('stripe.payment')->with('plan', $plan);
    }
    
    public function paymentForm()
    {
        $user = auth()->user();
        
        // Check if user has an active subscription
        if ($user->stripe_subscription_id) {
            try {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $subscription = \Stripe\Subscription::retrieve($user->stripe_subscription_id);
                if ($subscription->status === 'active' || $subscription->status === 'trialing') {
                    return redirect()->route('dashboard')->with('info', 'You already have an active subscription.');
                }
            } catch (\Exception $e) {
                // Subscription doesn't exist, clear the reference
                $user->stripe_subscription_id = null;
                $user->save();
            }
        }
        
        // If no selected plan in session, redirect to plan selection
        if (!session('selected_plan')) {
            return redirect()->route('admin.stripe')->with('error', 'Please select a plan first.');
        }
        
        return view('admin.album.stripe.stripe_elements');
    }
    
    public function createPaymentIntent(Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            $user = auth()->user();
            $planName = $request->input('plan_name', 'premium');
            $planPrice = $request->input('plan_price', 999);
            
            // Create or retrieve customer
            $customer = null;
            if ($user->stripe_customer_id) {
                try {
                    $customer = \Stripe\Customer::retrieve($user->stripe_customer_id);
                } catch (\Exception $e) {
                    $customer = null;
                }
            }
            
            if (!$customer) {
                $customer = \Stripe\Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                ]);
                $user->stripe_customer_id = $customer->id;
                $user->save();
            }
            
            // Check if user already has an active subscription
            if ($user->stripe_subscription_id) {
                try {
                    $existingSubscription = \Stripe\Subscription::retrieve($user->stripe_subscription_id);
                    if ($existingSubscription->status === 'active' || $existingSubscription->status === 'trialing') {
                        return response()->json(['error' => 'User already has an active subscription'], 400);
                    }
                } catch (\Exception $e) {
                    // Subscription doesn't exist in Stripe, clear the local reference
                    $user->stripe_subscription_id = null;
                    $user->save();
                }
            }
            
            // First, create a product and price
            $product = \Stripe\Product::create([
                'name' => ucfirst($planName) . ' Plan',
                'description' => 'Snapshot Albums ' . ucfirst($planName) . ' Subscription',
            ]);
            
            $price = \Stripe\Price::create([
                'product' => $product->id,
                'unit_amount' => $planPrice,
                'currency' => 'usd',
                'recurring' => [
                    'interval' => 'month',
                ],
            ]);
            
            // Create subscription with trial period and payment method collection
            $subscription = \Stripe\Subscription::create([
                'customer' => $customer->id,
                'items' => [[
                    'price' => $price->id,
                ]],
                'trial_period_days' => 7, // 7-day trial
                'payment_behavior' => 'default_incomplete', // Require payment method upfront
                'payment_settings' => [
                    'save_default_payment_method' => 'on_subscription',
                ],
                'expand' => ['latest_invoice.payment_intent'],
                'metadata' => [
                    'user_id' => $user->id,
                    'plan_name' => $planName,
                ],
            ]);
            
            // Update user with subscription info
            $user->stripe_subscription_id = $subscription->id;
            $user->plan = $planName;
            $user->subscription_active = true; // Active during trial
            $user->trial_ends_at = now()->addDays(7);
            $user->save();
            
            // For trial subscriptions, we need to create a setup intent for payment method collection
            $setupIntent = \Stripe\SetupIntent::create([
                'customer' => $customer->id,
                'payment_method_types' => ['card'],
                'usage' => 'off_session',
            ]);
            
            // Return the setup intent client secret for payment method collection
            return response()->json([
                'clientSecret' => $setupIntent->client_secret,
                'subscriptionId' => $subscription->id,
                'status' => $subscription->status,
                'trialEnd' => $subscription->trial_end,
                'isTrial' => true,
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Stripe createPaymentIntent error: ' . $e->getMessage());
            \Log::error('User ID: ' . $user->id . ', Plan: ' . $planName . ', Price: ' . $planPrice);
            return response()->json(['error' => 'Failed to create payment intent: ' . $e->getMessage()], 500);
        }
    }
    
    public function success(Request $request)
    {
        $user = auth()->user();
        
        // Get the setup intent from Stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        try {
            $setupIntent = \Stripe\SetupIntent::retrieve($request->setup_intent);
            
            if ($setupIntent->status === 'succeeded') {
                // Payment method has been saved successfully
                $user->subscription_active = true;
                $user->save();
                
                // Create payment record
                UserPayment::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'name' => $user->name,
                        'payment_id' => $setupIntent->id,
                    ]
                );
                
                return redirect()->route('dashboard')->with('success', 'Payment method added successfully! Your 7-day free trial has started. You will be charged ' . ucfirst($user->plan) . ' after the trial period.');
            }
            
            return redirect()->route('dashboard')->with('error', 'Payment method setup was not successful.');
            
        } catch (\Exception $e) {
            \Log::error('Stripe success error: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'An error occurred while processing your payment method.');
        }
    }
    
    public function testSubscription(Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            $user = auth()->user();
            $planName = $request->input('plan', 'premium');
            $planPrice = $planName === 'basic' ? 599 : 999;
            
            // Create or retrieve customer
            $customer = null;
            if ($user->stripe_customer_id) {
                try {
                    $customer = \Stripe\Customer::retrieve($user->stripe_customer_id);
                } catch (\Exception $e) {
                    $customer = null;
                }
            }
            
            if (!$customer) {
                $customer = \Stripe\Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                ]);
                $user->stripe_customer_id = $customer->id;
                $user->save();
            }
            
            // First, create a product and price
            $product = \Stripe\Product::create([
                'name' => ucfirst($planName) . ' Plan',
                'description' => 'Snapshot Albums ' . ucfirst($planName) . ' Subscription',
            ]);
            
            $price = \Stripe\Price::create([
                'product' => $product->id,
                'unit_amount' => $planPrice,
                'currency' => 'usd',
                'recurring' => [
                    'interval' => 'month',
                ],
            ]);
            
            // Create subscription with trial period and payment method collection
            $subscription = \Stripe\Subscription::create([
                'customer' => $customer->id,
                'items' => [[
                    'price' => $price->id,
                ]],
                'trial_period_days' => 7, // 7-day trial
                'payment_behavior' => 'default_incomplete', // Require payment method upfront
                'payment_settings' => [
                    'save_default_payment_method' => 'on_subscription',
                ],
                'expand' => ['latest_invoice.payment_intent'],
                'metadata' => [
                    'user_id' => $user->id,
                    'plan_name' => $planName,
                ],
            ]);
            
            // Update user with subscription info
            $user->stripe_subscription_id = $subscription->id;
            $user->plan = $planName;
            $user->subscription_active = true;
            $user->trial_ends_at = now()->addDays(7);
            $user->save();
            
            return response()->json([
                'success' => true,
                'subscription_id' => $subscription->id,
                'status' => $subscription->status,
                'trial_end' => $subscription->trial_end,
                'message' => 'Subscription created successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function cancelSubscription(Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            $user = auth()->user();
            
            if (!$user->stripe_subscription_id) {
                return redirect()->back()->with('error', 'No active subscription found.');
            }
            
            // Cancel the subscription at the end of the current period
            $subscription = \Stripe\Subscription::retrieve($user->stripe_subscription_id);
            $subscription->cancel_at_period_end = true;
            $subscription->save();
            
            // Update user status
            $user->subscription_active = false; // Will be active until period ends
            $user->save();
            
            // Calculate when subscription will end
            $cancelDate = \Carbon\Carbon::createFromTimestamp($subscription->current_period_end);
            
            return redirect()->back()->with('success', 
                'Your subscription has been cancelled. You will continue to have access until ' . 
                $cancelDate->format('M d, Y') . '. You will not be charged again.'
            );
            
        } catch (\Exception $e) {
            \Log::error('Subscription cancellation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to cancel subscription. Please try again or contact support.');
        }
    }
    
    public function reactivateSubscription(Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            $user = auth()->user();
            
            if (!$user->stripe_subscription_id) {
                return redirect()->back()->with('error', 'No subscription found.');
            }
            
            // Reactivate the subscription
            $subscription = \Stripe\Subscription::retrieve($user->stripe_subscription_id);
            $subscription->cancel_at_period_end = false;
            $subscription->save();
            
            // Update user status
            $user->subscription_active = true;
            $user->save();
            
            return redirect()->back()->with('success', 'Your subscription has been reactivated. You will continue to be billed monthly.');
            
        } catch (\Exception $e) {
            \Log::error('Subscription reactivation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to reactivate subscription. Please try again or contact support.');
        }
    }
    
    public function subscriptionManagement()
    {
        $user = auth()->user();
        
        if (!$user->stripe_subscription_id) {
            return redirect()->route('pricing')->with('error', 'No active subscription found.');
        }
        
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $subscription = \Stripe\Subscription::retrieve($user->stripe_subscription_id);
            
            return view('admin.subscription.management', compact('subscription', 'user'));
            
        } catch (\Exception $e) {
            \Log::error('Subscription management error: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Unable to load subscription details.');
        }
    }
    
    public function stripePost(Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            $user = auth()->user();
            
            // Get the selected plan details
            $planName = $request->input('plan_name', 'premium');
            $planPrice = $request->input('plan_price', 999); // Default to premium price
            
            // Create or retrieve customer
            $customer = null;
            if ($user->stripe_customer_id) {
                try {
                    $customer = \Stripe\Customer::retrieve($user->stripe_customer_id);
                } catch (\Exception $e) {
                    // Customer doesn't exist, create new one
                    $customer = null;
                }
            }
            
            if (!$customer) {
                $customer = \Stripe\Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'source' => $request->stripeToken,
                ]);
            } else {
                // Add new card to existing customer
                $customer->sources->create(['source' => $request->stripeToken]);
            }

            $user->stripe_customer_id = $customer->id;
            $user->renew_status = "1"; // Assign the status value
            $user->plan = $planName; // Set the user's plan
            $user->subscription_active = true; // Mark as active
            $user->save();

            $charge = \Stripe\Charge::create([
                "amount" => $planPrice, // Use the selected plan price
                "currency" => "usd",
                "customer" => $customer->id,
                "description" => ucfirst($planName) . " Package - $" . number_format($planPrice / 100, 2) . "/month"
            ]);

              // Find the UserPayment record for the user
              $userPayment = UserPayment::where('user_id', $user->id)->first();

              if ($userPayment) {
                  // Update the existing record
                  $userPayment->name = $user->name;
                  $userPayment->payment_id = $charge->id;
                  $userPayment->save();
              } else {
                  // Create a new record if none exists
                  UserPayment::create([
                      'user_id' => $user->id,
                      'name' => $user->name,
                      'payment_id' => $charge->id,
                  ]);
              }
        
            Session::flash('success', 'Payment successful! Your ' . ucfirst($planName) . ' plan is now active.');
            return redirect()->route('dashboard');
        } catch (\Stripe\Exception\CardException $e) {
            // Handle card errors and set an error message in the session
            return redirect()->back()->with('error', 'Card was declined: ' . $e->getMessage());
        } catch (\Stripe\Exception\RateLimitException $e) {
            return redirect()->back()->with('error', 'Too many requests. Please try again later.');
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return redirect()->back()->with('error', 'Invalid request: ' . $e->getMessage());
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return redirect()->back()->with('error', 'Authentication failed. Please contact support.');
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return redirect()->back()->with('error', 'Network error. Please try again.');
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return redirect()->back()->with('error', 'Payment error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }
    
    public function store(Request $request)
    {
        // Insert data into the "contact" table using the DB facade
        DB::table('contact')->insert([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'message' => $request['message'],
        ]);

        // Send an email with the form data
        $formData = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'message' => $request['message'],
        ];

        Mail::send('emails.contact', $formData, function ($message) use ($formData) {
            $message->to('umarzahid1996@gmail.com')
                ->subject('New Contact Form Submission');
        });

        // Redirect back to the form with a success message
        return redirect()->back()->with('success', 'Contact form submitted successfully!');
    }
}