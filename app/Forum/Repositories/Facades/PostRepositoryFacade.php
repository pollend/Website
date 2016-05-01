<?php


namespace PN\Forum\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Forum\Repositories\PostRepositoryInterface;

class PostRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return PostRepositoryInterface::class;
    }
}