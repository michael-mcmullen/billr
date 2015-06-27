<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Bill;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Mail;

class SendEmail extends Job implements SelfHandling
{

    private $user_id;
    private $bill_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $bill_id)
    {
        $this->user_id = $user_id;
        $this->bill_id = $bill_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->user_id);
        $bill = Bill::find($this->bill_id);

        if(empty($user))
            return false;

        // validate
        if(empty($user['email']))
            return false;

        // Try to send an Email
        Mail::send('emails.email.notification', ['bill' => $bill], function ($message) use ($user, $bill) {
            $message->from('notifications@mybillr.com');
            $message->subject('Upcoming Bill - '. $bill->company['name'] .' ('. $bill['amount'] .') on '. date('F d, Y', strtotime($bill['due'])));

            $message->to($user['email']);
        });
    }
}
