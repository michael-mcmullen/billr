<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Mail;

class TestEmail extends Job implements SelfHandling
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
        if(empty($user['email']))
            return false;

        // Try to send an Email
        Mail::send('emails.email.test', [], function ($message) use ($user) {
            $message->from('sms@mybillr.com');
            $message->subject('Upcoming Bill Notification [test]');

            $message->to($user['email']);
        });
    }
}
