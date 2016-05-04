<?php


namespace PN\Client\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Client\Repositories\ClientRepositoryInterface;

class ClientRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return ClientRepositoryInterface::class;
    }
}