<?php


namespace PN\Media\Repositories\Facades;


use Illuminate\Support\Facades\Facade;
use PN\Media\Repositories\ScreenshotRepositoryInterface;

class ScreenshotRepositoryFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return ScreenshotRepositoryInterface::class;
    }
}