<?php


namespace App\Http\Middleware;

use App\Models\Frontend\Winner;
use Closure;
use Illuminate\Http\Request;

class CheckWinner
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
        $device_id = $request->header('device_id');
        $winner = Winner::where('device_id', $device_id)->first();

        if ($winner) {
            return redirect()->route('unauthorize');
        }
        return $next($request);
        // return response()->view('frontend.participated', [], 401);
        // return response()->json(['message' => 'Unauthorized'], 401);
        // return $next($request);
    }
}
