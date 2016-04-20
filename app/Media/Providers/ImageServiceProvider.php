<?php


namespace PN\Media\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Media\Repositories\ImageRepository;
use PN\Media\Repositories\ImageRepositoryInterface;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ImageRepositoryInterface::class, ImageRepository::class);
    }
}