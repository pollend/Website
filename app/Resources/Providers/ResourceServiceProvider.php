<?php

namespace PN\Resources\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Resources\Http\Controllers\ResourceController;
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
        \Route::get('media/images/{filename}', [
            'as' => 'media.images',
            'uses' => ResourceController::class.'@images'
        ]);

        \Route::get('resources/download/{identifier}', [
            'as' => 'resources.download',
            'uses' => ResourceController::class.'@download'
        ]);
        $this->app->bind('resources.resourceutil', ResourceUtil::class);
    }
}
