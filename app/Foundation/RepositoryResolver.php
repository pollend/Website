<?php


namespace PN\Foundation;


use PN\Assets\Asset;
use PN\Assets\Repositories\AssetRepositoryInterface;
use PN\Forum\Post;
use PN\Forum\Repositories\PostRepositoryInterface;
use PN\Media\Repositories\ScreenshotRepositoryInterface;
use PN\Media\Screenshot;

class RepositoryResolver
{
    private static $models = [
        Asset::class => AssetRepositoryInterface::class,
        Screenshot::class => ScreenshotRepositoryInterface::class,
        Post::class => PostRepositoryInterface::class,
    ];

    public static function resolve($model) {
        return app(self::$models[$model]);
    }
}