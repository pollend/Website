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
    public function findByUsername(string $username);

    /**
     * Finds user by steam id
     *
     * @param string $steamId
     * @return User
     */
    public function findBySteamId(string $steamId);

    /**
     * Finds user by token
     * 
     * @param $token
     * @return mixed
     */
    public function findByConfirmToken($token);
}
