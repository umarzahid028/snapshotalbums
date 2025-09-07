<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CreateFolder;
use App\Models\UserPayment;
use App\Models\User;
use App\Mail\MailBeforeEvent;
use App\Mail\MailAfterEvent;
use Carbon\Carbon;
use Stripe;
use Illuminate\Support\Facades\Mail;

class SendEventEmails extends Command
{
    protected $signature = 'send:event-emails';
    protected $description = 'Send emails to users before and after their events';

    public function handle()
    {
        // 1 week before event
        $oneWeekBefore = Carbon::now()->addWeek()->toDateString();
        $eventsBefore = CreateFolder::whereDate('date_of_event', $oneWeekBefore)->get();

        foreach ($eventsBefore as $event) {
            $user = User::find($event->user_id);
            if ($user) {
                Mail::to($user->email)->send(new MailBeforeEvent($event));
            }
        }

        // 1 day after event
        $oneDayAfter = Carbon::now()->subDay()->toDateString();
        $eventsAfter = CreateFolder::whereDate('date_of_event', $oneDayAfter)->get();

        foreach ($eventsAfter as $event) {
            $user = User::find($event->user_id);
            if ($user) {
                Mail::to($user->email)->send(new MailAfterEvent($event));
            }
        }

/*   Testing: Send both mails to kamrannazir901@gmail.com every second
         $testEvent = CreateFolder::find(51);
         if ($testEvent) {
             Mail::to('kamrannazir901@gmail.com')->send(new MailBeforeEvent($testEvent));
             Mail::to('kamrannazir901@gmail.com')->send(new MailAfterEvent($testEvent));
         } else {
             \Log::error('Test folder with id 44 not found.');
         }
*/


                // For recurring payment
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

                // Fetch users to charge
                $usersToCharge = UserPayment::whereDate('updated_at', '<=', Carbon::now()->subYear())
                    ->with('user')
                    ->get();

                foreach ($usersToCharge as $payment) {
                    $user = $payment->user; 

                    try {
                        if ($user && $user->renew_status == '1') { 
                            if ($user->stripe_customer_id) {
                                $customer = $stripe->customers->retrieve($user->stripe_customer_id);
                            
                                if ($customer) {
                                    $charge = Stripe\Charge::create([
                                        "amount" => 99 * 100,
                                        "currency" => "usd",
                                        "customer" => $user->stripe_customer_id,
                                        "description" => "Yearly Premium Package."
                                    ]);

                                    // Update payment_id and updated_at
                                    $payment->update([
                                        'payment_id' => $charge->id,
                                        'updated_at' => Carbon::now(),
                                    ]);

                                    \Log::info('User charged successfully', ['user_id' => $user->id, 'payment_id' => $charge->id]);
                                } else {
                                    $payment->delete();
                                    \Log::info('Deleted payment record due to missing customer', ['user_id' => $user->id, 'payment_id' => $payment->payment_id]);
                                }
                            } else {
                                \Log::warning('User missing stripe_customer_id', ['user_id' => $user->id]);
                            }
                        }
                    } catch (\Stripe\Exception\InvalidRequestException $e) {
                        if ($e->getStripeCode() === 'resource_missing') {
                            $payment->delete();
                            \Log::info('Deleted payment record due to missing customer', ['user_id' => $user->id, 'payment_id' => $payment->payment_id]);
                        } else {
                            \Log::error('Error charging user', ['user_id' => $user->id, 'error' => $e->getMessage()]);
                        }
                    } catch (\Exception $e) {
                        \Log::error('Unexpected error', ['user_id' => $user->id, 'error' => $e->getMessage()]);
                    }
                }




    }


}