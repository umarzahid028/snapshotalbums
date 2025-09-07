<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SubscriptionCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subscription;
    public $accessEndDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $subscription = null)
    {
        $this->user = $user;
        $this->subscription = $subscription;
        $this->accessEndDate = $subscription ? 
            \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)->format('M d, Y') : 
            now()->format('M d, Y');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscription.cancelled')
                    ->subject('Subscription Cancelled - Access Until ' . $this->accessEndDate)
                    ->with([
                        'user' => $this->user,
                        'subscription' => $this->subscription,
                        'accessEndDate' => $this->accessEndDate,
                        'reactivateUrl' => env('APP_URL') . '/stripe/reactivate-subscription',
                        'supportEmail' => config('mail.support_email', 'support@snapshotalbums.com')
                    ]);
    }
}
