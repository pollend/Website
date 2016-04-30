<?php


namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\User;

class RegenerateApiKey extends Job
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $this->user->api_key = md5(uniqid());

        \UserRepo::edit($this->user);
    }
}