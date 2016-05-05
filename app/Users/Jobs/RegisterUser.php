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

    private $social;

    /**
     * RegisterUser constructor.
     * @param $username
     * @param $name
     * @param $email
     * @param $password
     * @param $userRepo
     */
    public function __construct($username, $name, $email, $password, $social = false)
    {
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->social = $social;
    }

    public function handle()
    {
        $user = new User();

        $user->username = $this->username;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = \Hash::make($this->password);
        $user->social = $this->social;

        if($this->social == 0) {
            $user->confirm_token = str_random(16);
        }

        \UserRepo::add($user);

        event(new UserRegistered($user));

        return $user;
    }
}
