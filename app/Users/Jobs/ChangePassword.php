<?php


namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\User;

/**
 * Class ChangePassword
 * @package PN\Users\Jobs
 */
class ChangePassword extends Job
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    /**
     * ChangePassword constructor.
     * @param User $user
     * @param string $password
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function handle()
    {
        $this->user->password = \Hash::make($this->password);

        \UserRepo::edit($this->user);
    }
}