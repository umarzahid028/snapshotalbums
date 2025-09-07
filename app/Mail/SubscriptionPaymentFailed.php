<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SubscriptionPaymentFailed extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subscription;
    public $retryDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $subscription = null)
    {
        $this->user = $user;
        $this->subscription = $subscription;
        $this->retryDate = now()->addDays(3)->format('M d, Y');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscription.payment-failed')
                    ->subject('Payment Failed - Action Required')
                    ->with([
                        'user' => $this->user,
                        'subscription' => $this->subscription,
                        'retryDate' => $this->retryDate,
                        'updateUrl' => env('APP_URL') . '/stripe/payment',
                        'supportEmail' => config('mail.support_email', 'support@snapshotalbums.com')
                    ]);
    }
}
