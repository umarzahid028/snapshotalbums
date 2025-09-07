<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccess
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
       if(Auth::check() && Auth::user()->role->id == 2 || Auth::user()->role->id == 3 || Auth::user()->role->id == 4)
        {
            if(Auth::check() && Auth::user()->status == 'Approved')
            {
            return $next($request);
            }
            else
            {
                Auth::logout();
                return redirect()->route('login')->with('error','Your account has not been approved yet ');
            }
        }
       
        else 
        {
            return redirect()->route('login')->with('error', 'You are not authorized to perform this action.');
        }
    }
}
