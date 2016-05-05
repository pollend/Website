<?php


namespace PN\Tracking\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Tracking\Http\Controllers\Api\ApiDownloadController;
use PN\Tracking\Repositories\DownloadRepository;
use PN\Tracking\Repositories\DownloadRepositoryInterface;
use PN\Tracking\Repositories\ViewRepository;
use PN\Tracking\Repositories\ViewRepositoryInterface;

class TrackingServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $router = $this->app['router'];

        $router->get('api/downloads/add/{type}/{id}', [
            'uses' => ApiDownloadController::class . '@addDownload',
        ]);

        $this->app->singleton(DownloadRepositoryInterface::class, DownloadRepository::class);
        $this->app->singleton(ViewRepositoryInterface::class, ViewRepository::class);
    }
}
