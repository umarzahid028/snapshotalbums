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

        // If trial has expired, redirect to payment
        if ($user->plan === 'trial' && $user->trial_ends_at && now()->isAfter($user->trial_ends_at)) {
            return redirect('/pricing')->with('error', 'Your 7-day trial has expired. Please subscribe to continue using premium features.');
        }

        // If user is on free plan, allow limited access
        if ($user->plan === 'free') {
            return $next($request);
        }

        // Default: redirect to pricing page
        return redirect('/pricing')->with('error', 'Please subscribe to access premium features.');
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
}
