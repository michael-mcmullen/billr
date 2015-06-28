<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Bill;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Mail;

class SendSMS extends Job implements SelfHandling
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
        $user = User::find($this->user_id);
        $bill = Bill::find($this->bill_id);

        $template = 'emails.sms.notification';

        if($this->isOverDue)
            $template = 'emails.sms.notification_overdue';

        if(empty($user))
            return false;

        // validate
        if(empty($user['phone_number']) || empty($user['phone_provider']))
            return false;

        // Try to send a SMS

        Mail::send($template, ['bill' => $bill], function ($message) use ($user) {
            $message->from('sms@mybillr.com', 'MyBillr Notification');
            //$message->subject('Upcoming Bill');

            $message->to($user['phone_number'] . $user['phone_provider']);
        });
    }
}
