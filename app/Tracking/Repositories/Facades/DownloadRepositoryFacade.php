<?php


namespace PN\Tracking\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Tracking\Repositories\DownloadRepositoryInterface;

class DownloadRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return DownloadRepositoryInterface::class;
    }
}