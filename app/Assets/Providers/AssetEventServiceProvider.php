<?php


namespace PN\Assets\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use PN\Assets\Events\UserDownloadedAsset;
use PN\Assets\Events\UserViewingAsset;
use PN\Assets\Listeners\AddDownloadToAsset;
use PN\Assets\Listeners\AddViewToAsset;

class AssetEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        UserViewingAsset::class => [
            AddViewToAsset::class
        ],
        UserDownloadedAsset::class => [
            AddDownloadToAsset::class
        ]
    ];
}