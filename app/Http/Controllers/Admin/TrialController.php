<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TrialController extends Controller
{
    /**
     * Display trial analytics dashboard
     */
    public function index()
    {
        // Get trial statistics
        $totalTrials = User::where('plan', 'trial')->count();
        $activeTrials = User::where('plan', 'trial')
            ->where('trial_ends_at', '>', now())
            ->count();
        $expiredTrials = User::where('plan', 'trial')
            ->where('trial_ends_at', '<', now())
            ->count();
        $expiringToday = User::where('plan', 'trial')
            ->whereDate('trial_ends_at', now()->toDateString())
            ->count();
        $expiringThisWeek = User::where('plan', 'trial')
            ->where('trial_ends_at', '<=', now()->addDays(7))
            ->where('trial_ends_at', '>', now())
            ->count();

        // Get recent trial users
        $recentTrials = User::where('plan', 'trial')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get expiring trials
        $expiringTrials = User::where('plan', 'trial')
            ->where('trial_ends_at', '<=', now()->addDays(7))
            ->where('trial_ends_at', '>', now())
            ->orderBy('trial_ends_at', 'asc')
            ->get();

        // Get expired trials
        $expiredTrialsList = User::where('plan', 'trial')
            ->where('trial_ends_at', '<', now())
            ->orderBy('trial_ends_at', 'desc')
            ->limit(20)
            ->get();

        return view('admin.trials.index', compact(
            'totalTrials',
            'activeTrials', 
            'expiredTrials',
            'expiringToday',
            'expiringThisWeek',
            'recentTrials',
            'expiringTrials',
            'expiredTrialsList'
        ));
    }

    /**
     * Get trial analytics data for charts
     */
    public function analytics()
    {
        // Trial signups by day (last 30 days)
        $signupsByDay = User::where('plan', 'trial')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Trial expirations by day (next 30 days)
        $expirationsByDay = User::where('plan', 'trial')
            ->where('trial_ends_at', '>=', now())
            ->where('trial_ends_at', '<=', now()->addDays(30))
            ->selectRaw('DATE(trial_ends_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'signups' => $signupsByDay,
            'expirations' => $expirationsByDay
        ]);
    }

    /**
     * Export trial data to CSV
     */
    public function export()
    {
        $trials = User::where('plan', 'trial')
            ->orderBy('trial_ends_at', 'asc')
            ->get();

        $filename = 'trials_' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($trials) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, ['Name', 'Email', 'Trial Started', 'Trial Ends', 'Status', 'Days Left']);
            
            foreach ($trials as $trial) {
                $status = $trial->trial_ends_at < now() ? 'Expired' : 'Active';
                $daysLeft = $trial->trial_ends_at > now() ? 
                    now()->diffInDays($trial->trial_ends_at, false) : 0;
                
                fputcsv($file, [
                    $trial->name,
                    $trial->email,
                    $trial->created_at->format('Y-m-d'),
                    $trial->trial_ends_at->format('Y-m-d'),
                    $status,
                    $daysLeft
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}