<?php


namespace PN\Social\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Social\Repositories\LikeRepositoryInterface;

class LikeRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return LikeRepositoryInterface::class;
    }
}