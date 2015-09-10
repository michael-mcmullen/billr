<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Company;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateCompany extends Job implements SelfHandling
{

    private $user_id;
    private $name;
    private $nickname;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $name, $nickname)
    {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->nickname = $nickname;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Company::create([
            'user_id'  => $this->user_id,
            'name'     => $this->name,
            'nickname' => $this->nickname
        ]);
    }
}
