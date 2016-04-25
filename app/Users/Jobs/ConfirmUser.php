<?php

namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\Events\UserConfirmed;
use PN\Users\Repositories\UserRepositoryInterface;
use PN\Users\User;

class ConfirmUser extends Job
{
    private $user;

    /**
     * ConfirmUser constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $this->user->confirmed = 1;

        \UserRepo::edit($this->user);
        
        event(new UserConfirmed($this->user));
    }
}
