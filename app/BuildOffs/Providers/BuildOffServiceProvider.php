<?php

namespace PN\BuildOffs\Providers;


use Illuminate\Support\ServiceProvider;
use PN\BuildOffs\Repositories\BuildOffRepository;
use PN\BuildOffs\Repositories\BuildOffRepositoryInterface;

class BuildOffServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BuildOffRepositoryInterface::class, BuildOffRepository::class);
    }
}
