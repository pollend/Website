<?php

use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Users\Jobs\GenerateNewPasswordToken;
use PN\Users\User;

class GeneratePasswordTokenTest extends \Codeception\Test\Unit
{
    use DispatchesJobs;
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testGeneratePasswordToken()
    {
        //arrange
        $this->tester->disableEvents();

        $user = \Mockery::mock(User::class)->makePartial();
        $user->username = 'Nice_username';
        $user->password = '5555';
        $user->email = "some_email@email.com";
        $user->confirmed = 0;
        $user->password_token = "old_token";

        \UserRepo::shouldReceive("edit")->once()->with(\Mockery::type(User::class));

        //act
        $this->dispatch(new GenerateNewPasswordToken($user));

        //assert
        $this->assertFalse($user->password_token == "old_token");
    }
}
