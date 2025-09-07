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
         // Check if the authenticated user has any payment records
         if ($user->userPayments()->exists()) {
             return redirect()->back()->with('success', 'You already have a payment record.');
         }
         return view('admin.album.stripe.stripe_elements');
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
        
        return redirect()->route('admin.stripe')->with('plan', $plan);
    }
    
    public function createPaymentIntent(Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            $user = auth()->user();
            $planName = $request->input('plan_name', 'premium');
            $planPrice = $request->input('plan_price', 999);
            
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $planPrice,
                'currency' => 'usd',
                'metadata' => [
                    'user_id' => $user->id,
                    'plan_name' => $planName,
                    'plan_price' => $planPrice,
                ],
            ]);
            
            return response()->json(['clientSecret' => $paymentIntent->client_secret]);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function success(Request $request)
    {
        $user = auth()->user();
        
        // Get the payment intent from Stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntent = \Stripe\PaymentIntent::retrieve($request->payment_intent);
        
        if ($paymentIntent->status === 'succeeded') {
            // Update user's plan
            $planName = $paymentIntent->metadata->plan_name ?? 'premium';
            $planPrice = $paymentIntent->metadata->plan_price ?? 999;
            
            $user->plan = $planName;
            $user->subscription_active = true;
            $user->renew_status = "1";
            $user->save();
            
            // Create payment record
            UserPayment::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => $user->name,
                    'payment_id' => $paymentIntent->id,
                ]
            );
            
            return redirect()->route('dashboard')->with('success', 'Payment successful! Your ' . ucfirst($planName) . ' plan is now active.');
        }
        
        return redirect()->route('dashboard')->with('error', 'Payment was not successful.');
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