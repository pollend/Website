<?php

namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\Events\UserConfirmed;
use PN\Users\Repositories\UserRepositoryInterface;

class ConfirmUser extends Job
{
    private $userId;

    private $userRepo;

    /**
     * ConfirmUser constructor.
     * @param $userId
     */
    public function __construct($userId, UserRepositoryInterface $userRepo)
    {
        $this->userId = $userId;
        $this->userRepo = $userRepo;
    }

    public function handle()
    {
        $user = $this->userRepo->find($this->userId);

        $user->confirmed = 1;

        $user->save();

        event(new UserConfirmed($user));
    }
}
