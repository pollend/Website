<?php


namespace PN\Resources\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Resources\Repositories\ResourceRepositoryInterface;

class ResourceRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return ResourceRepositoryInterface::class;
    }
}