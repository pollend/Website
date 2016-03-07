<?php

namespace Tests\Users\Controllers;


use Tests\FactoryTrait;

class AuthControllerTest extends \TestCase
{
    use FactoryTrait;

    public function test_register()
    {
        \Mail::shouldReceive('send');

        $this->visit(route('auth.register'))
            ->submitForm('Register', [
                'username' => 'Nice_username',
                'name' => 'Even nicer name',
                'email' => 'ihaveaweakpass@ema.il',
                'password' => '123456',
                'password_confirmation' => '123456',
            ])->seePageIs(route('auth.login'));
    }

    public function test_password_needs_confirmation()
    {
        $this->visit(route('auth.register'))
            ->submitForm('Register', [
                'username' => 'Nice_username',
                'name' => 'Even nicer name',
                'email' => 'ihaveaweakpass@ema.il',
                'password' => '123456',
                'password_confirmation' => '1234256',
            ])->seePageIs(route('auth.register'));
    }

    public function test_needs_valid_email()
    {
        $this->visit(route('auth.register'))
            ->submitForm('Register', [
                'username' => 'Nice_username',
                'name' => 'Even nicer name',
                'email' => 'ih  ma.il',
                'password' => '123456',
                'password_confirmation' => '123456',
            ])->seePageIs(route('auth.register'));
    }

    public function test_login()
    {
        $this->createUser([
            'username' => 'Nice_username',
            'name' => 'Even nicer name',
            'email' => 'info@email.com',
            'password' => '123456',
        ]);

        $this->visit(route('auth.login'))
            ->submitForm('Login', [
                'email' => 'info@email.com',
                'password' => '123456',
            ])->seePageIs(route('home.index'));
    }
}
