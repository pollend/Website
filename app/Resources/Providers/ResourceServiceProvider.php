<?php

namespace PN\Resources\Providers;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\ServiceProvider;
use PN\Resources\Http\Controllers\ResourceController;
use PN\Media\Image;
use PN\Media\ImageObserver;
use PN\Media\Jobs\ResizeImage;
use PN\Resources\Repositories\ResourceRepository;
use PN\Resources\Repositories\ResourceRepositoryInterface;
use PN\Resources\ResourceUtil;
use PN\Resources\Stats\Repositories\StatRepository;
use PN\Resources\Stats\Repositories\StatRepositoryInterface;

class ResourceServiceProvider extends ServiceProvider
{
    use DispatchesJobs;

    public function boot()
    {
        Image::observe(new ImageObserver());
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \Route::get('media/images/{size}/{filename}', [
            'as' => 'media.images',
            'uses' => ResourceController::class.'@images'
        ]);

        \Route::get('media/avatars/{filename}', [
            'as' => 'media.avatars',
            'uses' => ResourceController::class.'@avatars'
        ]);

        \Route::get('resources/download/{identifier}', [
            'as' => 'resources.download',
            'uses' => ResourceController::class.'@download'
        ]);

        $this->app->bind('resources.resourceutil', ResourceUtil::class);
        $this->app->singleton(StatRepositoryInterface::class, StatRepository::class);
        $this->app->singleton(ResourceRepositoryInterface::class, ResourceRepository::class);
    }
}
