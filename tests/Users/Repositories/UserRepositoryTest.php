<?php

namespace Tests\Users\Repositories;


use PN\Users\Repositories\UserRepositoryInterface;
use Tests\FactoryTrait;

class UserRepositoryTest extends \TestCase
{
    use FactoryTrait;

    private $userRepo;

    public function setUp()
    {
        parent::setUp();

        $this->userRepo = app(UserRepositoryInterface::class);
    }

    public function test_find_by_email()
    {
        $this->createUser([
            'username' => 'Nice_username',
            'name' => 'Even nicer name',
            'email' => 'ihaveaweakpass@ema.il',
            'password' => '123456'
        ]);

        $this->assertNotNull($this->userRepo->findByEmail('ihaveaweakpass@ema.il'));
        $this->assertEquals($this->userRepo->findByEmail('dsdvsd@ema.il'), null);
    }

    public function test_validate_credentials()
    {
        $this->createUser([
            'username' => 'Nice_username',
            'name' => 'Even nicer name',
            'email' => 'ihaveaweakpass@ema.il',
            'password' => '123456'
        ]);

        $this->assertTrue($this->userRepo->validateCredentials('ihaveaweakpass@ema.il', '123456'));
        $this->assertFalse($this->userRepo->validateCredentials('ihaveaweakpass@ema.il', 'wrong pass'));
    }

    public function test_find_by_social()
    {
        $this->createUser([
            'username' => 'Nice_username',
            'name' => 'Even nicer name',
            'email' => 'ihaveaweakpass@ema.il',
            'password' => '123456',
            'social' => 1337,
            'social_name' => 'facebook'
        ]);

        $this->assertNotNull($this->userRepo->findBySocial(1337, 'facebook', 'ihaveaweakpass@ema.il'));
    }

    public function test_find_by_social_by_email()
    {
        $this->createUser([
            'username' => 'Nice_username',
            'name' => 'Even nicer name',
            'email' => 'ihaveaweakpass@ema.il',
            'password' => '123456'
        ]);

        $this->assertNotNull($this->userRepo->findBySocial(1337, 'facebook', 'ihaveaweakpass@ema.il'));
    }
}
