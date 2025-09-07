<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect('/');
        }

        // Check if user has an active subscription or trial
        if ($this->hasActiveSubscription($user)) {
            return $next($request);
        }

        // Check if user is in grace period after payment failure
        if ($this->isInGracePeriod($user)) {
            return redirect('/stripe/payment')->with('warning', 'Your payment failed. Please update your payment method within ' . $user->grace_period_ends_at->diffForHumans() . ' to restore access.');
        }

        // Check if user has failed payment (subscription exists but not active)
        if ($this->hasFailedPayment($user)) {
            return redirect('/stripe/payment')->with('error', 'Your payment failed. Please update your payment method to restore access.');
        }

        // If trial has expired, redirect to Stripe
        if ($user->plan === 'trial' && $user->trial_ends_at && now()->isAfter($user->trial_ends_at)) {
            return redirect('/stripe')->with('error', 'Your 7-day trial has expired. Please select a plan to continue.');
        }

        // If user is on free plan, allow limited access
        if ($user->plan === 'free') {
            return $next($request);
        }

        // If no active subscription or trial, redirect to Stripe
        if (!$user->stripe_subscription_id) {
            return redirect('/stripe')->with('error', 'Please select a plan to continue.');
        }

        // If no active subscription, redirect to Stripe
        return redirect('/stripe')->with('error', 'Please update your subscription to continue.');
    }

    /**
     * Check if user has an active subscription
     */
    private function hasActiveSubscription($user)
    {
        // Premium users with active subscription
        if ($user->plan === 'premium' && $user->subscription_active) {
            return true;
        }
        
        // Basic users with active subscription
        if ($user->plan === 'basic' && $user->subscription_active) {
            return true;
        }

        // Trial users within trial period
        if ($user->plan === 'trial' && $user->trial_ends_at && now()->isBefore($user->trial_ends_at)) {
            return true;
        }

        // Users with renew_status = 1 (legacy payment system)
        if ($user->renew_status == '1') {
            return true;
        }

        return false;
    }
    
    /**
     * Check if user has a subscription but payment failed
     */
    private function hasFailedPayment($user)
    {
        // User has a subscription ID but subscription is not active
        return $user->stripe_subscription_id && !$user->subscription_active;
    }
    
    /**
     * Check if user is in grace period after payment failure
     */
    private function isInGracePeriod($user)
    {
        return $user->payment_failed_at && 
               $user->grace_period_ends_at && 
               now()->isBefore($user->grace_period_ends_at) &&
               !$user->subscription_active;
    }
}
