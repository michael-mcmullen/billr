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
    private $isOverDue;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $bill_id, $isOverDue)
    {
        $this->user_id = $user_id;
        $this->bill_id = $bill_id;
        $this->isOverDue = $isOverDue;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // grab the user
        $user = User::find($this->user_id);
        // grab the bill
        $bill = Bill::find($this->bill_id);

        // check the user hasn't been disabled
        if(empty($user))
            return false;

        // validate that the user has an email
        if(empty($user['email']))
            return false;

        // setup the default template
        $template = 'emails.email.notification';
        // setup the default subject
        $subject  = 'Upcoming Bill - '. $bill->company['name'] .' ('. $bill['amount'] .') on '. date('F d, Y', strtotime($bill['due']));

        // check to see if this bill is over due
        if($this->isOverDue)
        {
            $template = 'emails.email.notification_overdue';
            $subject  = 'Overdue Bill - '. $bill->company['name'] .' ('. $bill['amount'] .') on '. date('F d, Y', strtotime($bill['due'])) .'!';
        }

        // Try to send an Email
        Mail::send($template, ['bill' => $bill], function ($message) use ($user, $subject) {
            $message->from('notifications@mybillr.com', 'MyBillr Notification');
            $message->subject($subject);

            $message->to($user['email']);
        });
    }
}
