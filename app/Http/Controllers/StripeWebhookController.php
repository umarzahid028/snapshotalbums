<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\SubscriptionPaymentFailed;
use App\Mail\SubscriptionCancelled;
use App\Mail\TrialEndingSoon;
use Stripe;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            Log::error('Invalid payload: ' . $e->getMessage());
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Invalid signature: ' . $e->getMessage());
            return response('Invalid signature', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'invoice.payment_succeeded':
                $this->handleInvoicePaymentSucceeded($event->data->object);
                break;
                
            case 'invoice.payment_failed':
                $this->handleInvoicePaymentFailed($event->data->object);
                break;
                
            case 'customer.subscription.updated':
                $this->handleSubscriptionUpdated($event->data->object);
                break;
                
            case 'customer.subscription.deleted':
                $this->handleSubscriptionDeleted($event->data->object);
                break;
                
            case 'customer.subscription.trial_will_end':
                $this->handleTrialWillEnd($event->data->object);
                break;
                
            default:
                Log::info('Unhandled event type: ' . $event->type);
        }

        return response('OK', 200);
    }

    private function handleInvoicePaymentSucceeded($invoice)
    {
        Log::info('Invoice payment succeeded: ' . $invoice->id);
        
        if ($invoice->subscription) {
            $user = User::where('stripe_subscription_id', $invoice->subscription)->first();
            
            if ($user) {
                // Check if this is the first payment after trial
                if ($invoice->billing_reason === 'subscription_cycle') {
                    Log::info('Trial ended - first payment successful for user: ' . $user->email);
                    $user->subscription_active = true;
                    $user->trial_ends_at = null; // Clear trial end date
                } else {
                    $user->subscription_active = true;
                }
                
                $user->save();
                Log::info('User subscription activated: ' . $user->email);
            } else {
                Log::warning('User not found for subscription: ' . $invoice->subscription);
            }
        }
    }

    private function handleInvoicePaymentFailed($invoice)
    {
        Log::info('Invoice payment failed: ' . $invoice->id);
        
        if ($invoice->subscription) {
            $user = User::where('stripe_subscription_id', $invoice->subscription)->first();
            
            if ($user) {
                // Check if this is the first payment after trial
                if ($invoice->billing_reason === 'subscription_cycle') {
                    Log::info('Trial ended - first payment failed for user: ' . $user->email);
                    $user->subscription_active = false; // Deactivate access
                    $user->trial_ends_at = null; // Clear trial end date
                } else {
                    $user->subscription_active = false;
                }
                
                // Set grace period - user has 3 days to fix payment
                $user->payment_failed_at = now();
                $user->grace_period_ends_at = now()->addDays(3);
                
                $user->save();
                Log::info('User subscription deactivated due to payment failure: ' . $user->email);
                
                // Send email notification to user about payment failure
                try {
                    Mail::to($user->email)->send(new SubscriptionPaymentFailed($user, $invoice));
                    Log::info('Payment failure email sent to: ' . $user->email);
                } catch (\Exception $e) {
                    Log::error('Failed to send payment failure email to ' . $user->email . ': ' . $e->getMessage());
                }
            }
        }
    }

    private function handleSubscriptionUpdated($subscription)
    {
        Log::info('Subscription updated: ' . $subscription->id);
        
        $user = User::where('stripe_subscription_id', $subscription->id)->first();
        
        if ($user) {
            if ($subscription->status === 'active') {
                $user->subscription_active = true;
                // Clear any payment failure flags if subscription is now active
                $user->payment_failed_at = null;
                $user->grace_period_ends_at = null;
            } elseif ($subscription->status === 'canceled' || $subscription->status === 'incomplete_expired') {
                $user->subscription_active = false;
                $user->plan = 'free'; // Reset to free plan
                
                // Send cancellation email
                try {
                    Mail::to($user->email)->send(new SubscriptionCancelled($user, $subscription));
                    Log::info('Cancellation email sent to: ' . $user->email);
                } catch (\Exception $e) {
                    Log::error('Failed to send cancellation email to ' . $user->email . ': ' . $e->getMessage());
                }
            } elseif ($subscription->cancel_at_period_end) {
                // Subscription is cancelled but still active until period end
                $user->subscription_active = false;
                Log::info('Subscription cancelled at period end for user: ' . $user->email);
                
                // Send cancellation email for end-of-period cancellation
                try {
                    Mail::to($user->email)->send(new SubscriptionCancelled($user, $subscription));
                    Log::info('End-of-period cancellation email sent to: ' . $user->email);
                } catch (\Exception $e) {
                    Log::error('Failed to send end-of-period cancellation email to ' . $user->email . ': ' . $e->getMessage());
                }
            }
            
            $user->save();
            Log::info('User subscription status updated: ' . $user->email . ' - Status: ' . $subscription->status);
        }
    }

    private function handleSubscriptionDeleted($subscription)
    {
        Log::info('Subscription deleted: ' . $subscription->id);
        
        $user = User::where('stripe_subscription_id', $subscription->id)->first();
        
        if ($user) {
            $user->subscription_active = false;
            $user->stripe_subscription_id = null;
            $user->save();
            
            Log::info('User subscription cancelled: ' . $user->email);
        }
    }

    private function handleTrialWillEnd($subscription)
    {
        Log::info('Trial will end: ' . $subscription->id);
        
        $user = User::where('stripe_subscription_id', $subscription->id)->first();
        
        if ($user) {
            // Send email notification about trial ending
            try {
                Mail::to($user->email)->send(new TrialEndingSoon($user));
                Log::info('Trial ending email sent to: ' . $user->email);
            } catch (\Exception $e) {
                Log::error('Failed to send trial ending email to ' . $user->email . ': ' . $e->getMessage());
            }
        }
    }
}
