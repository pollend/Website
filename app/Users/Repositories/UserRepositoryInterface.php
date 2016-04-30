<?php
namespace PN\Users\Repositories;

use PN\Users\User;

interface UserRepositoryInterface
{
    /**
     * Finds user by api key
     *
     * @param string $apiKey
     * @return User
     */
    public function findByApiKey(string $apiKey) : User;

    /**
     * Finds user by username
     *
     * @param string $username
     * @return User
     */
    public function findByUsername(string $username) : User;
}
