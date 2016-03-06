<?php

namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\Events\UsernameSet;
use PN\Users\Repositories\UserRepositoryInterface;

class SetUsername extends Job
{
    private $userId;

    private $username;

    private $userRepo;

    /**
     * SetUsername constructor.
     * @param $userId
     * @param $userRepo
     */
    public function __construct($userId, $username, UserRepositoryInterface $userRepo)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->userRepo = $userRepo;
    }

    public function handle()
    {
        $user = $this->userRepo->find($this->userId);

        $user->username = $this->username;

        $user->save();

        event(new UsernameSet($user));

        return $user;
    }
}
