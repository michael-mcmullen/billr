<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Mail;

class TestSMS extends Job implements SelfHandling
{

    private $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->user_id);

        if(empty($user))
            return false;

        // validate
        if(empty($user['phone_number']) || empty($user['phone_provider']))
            return false;

        // Try to send a SMS
        Mail::send('emails.sms.test', [], function ($message) use ($user) {
            $message->from('sms@mybillr.com');

            $message->to($user['phone_number'] . $user['phone_provider']);
        });
    }
}
