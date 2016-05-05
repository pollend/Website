<?php


namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\User;

/**
 * Class GenerateNewPasswordToken
 * @package PN\Users\Jobs
 */
class GenerateNewPasswordToken extends Job
{
    /**
     * @var User
     */
    private $user;

    /**
     * GenerateNewPasswordToken constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $password_token = md5($this->user->email . date('c') . uniqid());

        $this->user->password_token = $password_token;

        \UserRepo::edit($this->user);
    }
}