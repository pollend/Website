<?php


namespace PN\Social\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Social\Repositories\LikeRepository;
use PN\Social\Repositories\LikeRepositoryInterface;

class LikeServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LikeRepositoryInterface::class, LikeRepository::class);
    }
}