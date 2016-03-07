<?php

namespace Tests\Users\Jobs;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Users\Events\UserRegistered;
use PN\Users\Jobs\RegisterUser;
use PN\Users\Jobs\SendConfirmEmail;

class RegisterUserTest extends \TestCase
{
    use DispatchesJobs;

    public function test_register_job()
    {
        \Mail::shouldReceive('send');
        
        $userData = [
            'username' => 'Nice_username',
            'name' => 'Even nicer name',
            'email' => 'ihaveaweakpass@ema.il',
            'password' => '123456'
        ];

        $this->dispatch(app(RegisterUser::class, $userData));

        $this->seeInDatabase('users', array_except($userData, ['password']));
        $this->seeInDatabase('users', ['confirmed' => 0]);
    }

    public function test_register_fires_event()
    {
        $this->expectsEvents(UserRegistered::class);

        $userData = [
            'username' => 'Nice_username',
            'name' => 'Even nicer name',
            'email' => 'ihaveaweakpass@ema.il',
            'password' => '123456'
        ];

        $this->dispatch(app(RegisterUser::class, $userData));
    }
}
