<?php

namespace PN\Resources\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Resources\ResourceUtil;

class ResourceServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('resources.resourceutil', ResourceUtil::class);
    }
}
