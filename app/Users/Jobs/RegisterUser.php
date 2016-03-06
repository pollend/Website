<?php

namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\Events\UserRegistered;
use PN\Users\Repositories\UserRepositoryInterface;
use PN\Users\User;

class RegisterUser extends Job
{
    private $username;

    private $name;

    private $email;

    private $password;

    private $userRepo;

    /**
     * RegisterUser constructor.
     * @param $username
     * @param $name
     * @param $email
     * @param $password
     * @param $userRepo
     */
    public function __construct($username, $name, $email, $password, UserRepositoryInterface $userRepo)
    {
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->userRepo = $userRepo;
    }

    public function handle()
    {
        $user = new User();

        $user->username = $this->username;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = \Hash::make($this->password);

        $user->save();

        event(new UserRegistered($user));

        return $user;
    }
}
