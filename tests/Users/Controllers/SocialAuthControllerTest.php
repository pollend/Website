<?php

namespace Tests\Users\Controllers;


use PN\Users\Events\UsernameSet;
use Tests\FactoryTrait;

class SocialAuthControllerTest extends \TestCase
{
    use FactoryTrait;

    public function test_social_register_with_new_user()
    {
        $userData = new \stdClass();

        $userData->id = 1337;
        $userData->name = 'Name';
        $userData->email = 'info@email.com';
        $userData->avatar = 'test';

        $mock = \Mockery::mock('\Laravel\Socialite\Two\AbstractProvider');
        $mock->shouldReceive('user')
            ->once()
            ->andReturn($userData);

        \Socialite::shouldReceive('with')->andReturn($mock);

        $this->call('GET', route('socialauth.github.callback'), [
            'code' => 'test'
        ]);

        $this->followRedirects();

        // uri has encrypted identifier
        $this->assertTrue(starts_with($this->currentUri, route('socialauth.setusername')));
        $this->seeInDatabase('users', ['social_id' => 1337, 'confirmed' => 1]);
    }

    public function test_social_register_with_existing_user()
    {
        $user = $this->createUser(['confirmed' => 1]);

        $userData = new \stdClass();

        $userData->id = 1337;
        $userData->name = $user->name;
        $userData->email = $user->email;
        $userData->avatar = 'test';

        $mock = \Mockery::mock('\Laravel\Socialite\Two\AbstractProvider');
        $mock->shouldReceive('user')
            ->once()
            ->andReturn($userData);

        \Socialite::shouldReceive('with')->andReturn($mock);

        $this->call('GET', route('socialauth.github.callback'), [
            'code' => 'test'
        ]);

        $this->followRedirects();

        // uri has encrypted identifier
        $this->seePageIs(route('home.index'));
        $this->seeInDatabase('users', ['social_id' => 1337, 'confirmed' => 1]);
    }

    public function test_social_login()
    {
        $this->createUser([
            'name' => 'Name',
            'email' => 'info@email.com',
            'social_id' => 1337,
            'social_name' => 'github',
            'confirmed' => 1
        ]);

        $userData = new \stdClass();

        $userData->id = 1337;
        $userData->name = 'Name';
        $userData->email = 'info@email.com';
        $userData->avatar = 'test';

        $mock = \Mockery::mock('\Laravel\Socialite\Two\AbstractProvider');
        $mock->shouldReceive('user')
            ->once()
            ->andReturn($userData);

        \Socialite::shouldReceive('with')->andReturn($mock);

        $this->call('GET', route('socialauth.github.callback'), [
            'code' => 'test'
        ]);

        $this->followRedirects();

        // uri has encrypted identifier
        $this->seePageIs(route('home.index'));
        $this->seeInDatabase('users', ['social_id' => 1337, 'confirmed' => 1]);
    }

    public function test_set_username()
    {
        $this->expectsEvents(UsernameSet::class);

        $user = $this->createUser([
            'username' => '',
            'name' => 'Name',
            'email' => 'info@email.com',
            'social_id' => 1337,
            'social_name' => 'github',
            'confirmed' => 1
        ]);

        $this->visit(route('socialauth.setusername', [\Crypt::encrypt($user->identifier)]))
            ->submitForm('Save', [
                'username' => 'nice_username'
            ]);

        $this->seeInDatabase('users', ['username' => 'nice_username']);
    }
}
