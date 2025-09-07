<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TrialEndingSoon extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $trialEndDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->trialEndDate = $user->trial_ends_at ? 
            $user->trial_ends_at->format('M d, Y \a\t g:i A') : 
            now()->addDays(1)->format('M d, Y');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscription.trial-ending')
                    ->subject('Your Free Trial Ends Soon - ' . $this->trialEndDate)
                    ->with([
                        'user' => $this->user,
                        'trialEndDate' => $this->trialEndDate,
                        'upgradeUrl' => env('APP_URL') . '/stripe',
                        'supportEmail' => config('mail.support_email', 'support@snapshotalbums.com')
                    ]);
    }
}
