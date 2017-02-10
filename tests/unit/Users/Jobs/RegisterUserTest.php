<?php

use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Users\Jobs\RegisterUser;
use PN\Users\User;

class RegisterUserTest extends \Codeception\Test\Unit
{
    use DispatchesJobs;
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testRegisterUser()
    {
        //arrange
        $this->tester->disableEvents();

        \UserRepo::shouldReceive("add")->once()->with(\Mockery::on(function (User $user) {
            $this->assertTrue($user->username == 'Nice_username');
            $this->assertTrue($user->name == 'Even nicer name');
            $this->assertTrue($user->email == 'ihaveaweakpass@ema.il');
            return true;
        }));

        //act
        $user = $this->dispatch(new RegisterUser('Nice_username', 'Even nicer name', 'ihaveaweakpass@ema.il', '123456'));

        //assert;
        $this->assertTrue(\Hash::check('123456', $user->password));
    }
}
