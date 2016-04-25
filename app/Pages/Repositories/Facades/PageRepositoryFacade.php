<?php


namespace PN\Pages\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Pages\Repositories\PageRepositoryInterface;

class PageRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return PageRepositoryInterface::class;
    }
}