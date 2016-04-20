<?php

namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\Events\UserConfirmed;
use PN\Users\Repositories\UserRepositoryInterface;

class ConfirmUser extends Job
{
    private $userId;

    /**
     * ConfirmUser constructor.
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {
        $user = \UserRepo::find($this->userId);

        $user->confirmed = 1;

        \UserRepo::edit($user);
        
        event(new UserConfirmed($user));
    }
}
