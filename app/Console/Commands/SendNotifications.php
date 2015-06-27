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

        foreach($users as $user)
        {
            $this->comment($user['email']);

            if(! empty($user['notification_type']))
            {
                $bills = \App\Bill::next($user['notification_days'], false, $user['id']);

                foreach($bills as $bill)
                {
                    $this->comment($bill['amount']);

                    switch(strtolower($user['notification_type']))
                    {
                        case 'email':
                            $this->dispatch(new \App\Jobs\SendEmail($user['id'], $bill['id']));
                            break;
                        case 'sms':
                            $this->dispatch(new \App\Jobs\SendSMS($user['id'], $bill['id']));
                            break;
                    }
                }
            }
        }

    }
}
