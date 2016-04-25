<?php


namespace PN\BuildOffs\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\BuildOffs\Repositories\RankRepositoryInterface;

class RankRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return RankRepositoryInterface::class;
    }
}