<?php
namespace PN\Users\Repositories;

use PN\Users\User;

interface UserRepositoryInterface
{
    public function findByApiKey(string $apiKey) : User;
}
