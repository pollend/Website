<?php


namespace PN\Foundation\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Foundation\Repositories\OptionRepositoryInterface;

class OptionRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return OptionRepositoryInterface::class;
    }
}