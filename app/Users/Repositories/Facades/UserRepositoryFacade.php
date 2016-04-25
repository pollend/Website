<?php


namespace PN\Users\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Users\Repositories\UserRepositoryInterface;

class UserRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return UserRepositoryInterface::class;
    }
}