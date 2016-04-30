<?php


namespace PN\Tracking\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Tracking\Repositories\ViewRepositoryInterface;

class ViewRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return ViewRepositoryInterface::class;
    }
}