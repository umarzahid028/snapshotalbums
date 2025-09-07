<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckTrialExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trials:check {--days=7 : Number of days to check for expiration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired trials and send notifications';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $days = $this->option('days');
        $this->info("Checking for trials expiring in {$days} days...");
        
        // Find users whose trials are expiring soon
        $expiringSoon = User::where('plan', 'trial')
            ->where('trial_ends_at', '<=', now()->addDays($days))
            ->where('trial_ends_at', '>', now())
            ->get();
            
        // Find users whose trials have expired
        $expired = User::where('plan', 'trial')
            ->where('trial_ends_at', '<', now())
            ->get();
            
        // Find users whose trials expired today
        $expiredToday = User::where('plan', 'trial')
            ->whereDate('trial_ends_at', now()->toDateString())
            ->get();

        $this->info("Found {$expiringSoon->count()} trials expiring soon");
        $this->info("Found {$expired->count()} expired trials");
        $this->info("Found {$expiredToday->count()} trials expired today");

        // Display results
        if ($expiringSoon->count() > 0) {
            $this->table(
                ['Name', 'Email', 'Trial Ends', 'Days Left'],
                $expiringSoon->map(function ($user) {
                    $daysLeft = now()->diffInDays($user->trial_ends_at, false);
                    return [
                        $user->name,
                        $user->email,
                        $user->trial_ends_at->format('Y-m-d H:i:s'),
                        $daysLeft > 0 ? $daysLeft : 'Expired'
                    ];
                })
            );
        }

        if ($expiredToday->count() > 0) {
            $this->info("\n🚨 Trials expired TODAY:");
            $this->table(
                ['Name', 'Email', 'Trial Ended'],
                $expiredToday->map(function ($user) {
                    return [
                        $user->name,
                        $user->email,
                        $user->trial_ends_at->format('Y-m-d H:i:s')
                    ];
                })
            );
        }

        // Log the results
        Log::info("Trial Check Completed", [
            'expiring_soon' => $expiringSoon->count(),
            'expired' => $expired->count(),
            'expired_today' => $expiredToday->count()
        ]);

        return 0;
    }
}
