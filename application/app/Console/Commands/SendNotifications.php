<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendNotifications extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check and send any notifications';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = \App\User::all();

        // for each of our users
        foreach($users as $user)
        {
            // ensure they have a notification type selected
            if(! empty($user['notification_type']))
            {
                // grab all the bills for that user within the notification days
                $bills = \App\Bill::next($user['notification_days'], false, $user['id']);

                // go through each of the bills and send the appropriate notification
                foreach($bills as $bill)
                {
                    $this->comment('Sending bill reminder ['. $bill['id'] .'] for user ['. $user['id'] .']');

                    switch(strtolower($user['notification_type']))
                    {
                        case 'email':
                            $this->comment('Dispatching Email ...');
                            $this->dispatch(new \App\Jobs\SendEmail($user['id'], $bill['id'], false));
                            $this->comment('Email Dispatched');
                            break;
                        case 'sms':
                            $this->comment('Dispatching SMS ...');
                            $this->dispatch(new \App\Jobs\SendSMS($user['id'], $bill['id'], false));
                            $this->comment('SMS Dispatched');
                            break;
                    }
                }

                // while we are here, grab any overdue bills
                $bills = \App\Bill::before(date('Y-m-d'), false, $user['id']);

                // go through each of the bills and send the appropriate notification
                foreach($bills as $bill)
                {
                    $this->comment('Sending overdue bill ['. $bill['id'] .'] for user ['. $user['id'] .']');

                    switch(strtolower($user['notification_type']))
                    {
                        case 'email':
                            $this->comment('Dispatching Email ...');
                            $this->dispatch(new \App\Jobs\SendEmail($user['id'], $bill['id'], true));
                            $this->comment('Email Dispatched');
                            break;
                        case 'sms':
                            $this->comment('Dispatching SMS ...');
                            $this->dispatch(new \App\Jobs\SendSMS($user['id'], $bill['id'], true));
                            $this->comment('SMS Dispatched');
                            break;
                    }
                }
            }
        }

    }
}
