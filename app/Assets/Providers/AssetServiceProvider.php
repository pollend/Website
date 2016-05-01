<?php

namespace PN\Assets\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Assets\Http\Controllers\AssetController;
use PN\Assets\Http\Controllers\AssetManageController;
use PN\Assets\Repositories\AssetRepository;
use PN\Assets\Repositories\AssetRepositoryInterface;
use PN\Assets\Repositories\TagRepository;
use PN\Assets\Repositories\TagRepositoryInterface;

class AssetServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $router = $this->app['router'];

        $router->group(['middleware' => ['web']], function () use ($router) {
            $router->controller('assets/manage', AssetManageController::class, [
                'getSelectFile' => 'assets.manage.selectfile',
                'postSelectFile' => 'assets.manage.selectfile',
                'getCreate' => 'assets.manage.create',
            ]);
            $router->get('assets/{type}', [
                'as' => 'assets.filter',
                'uses' => AssetController::class . '@filterPage'
            ]);
            $router->get('assets/download/{identifier}', [
                'as' => 'assets.download',
                'uses' => AssetController::class . '@download'
            ]);
            $router->get('assets/{type}/filter', [
                'as' => 'assets.filter.list',
                'uses' => AssetController::class . '@filterAssets'
            ]);
            $router->controller('assets', AssetController::class, [
                'getShow' => 'assets.show',
            ]);
        });

        $this->app->singleton(AssetRepositoryInterface::class, AssetRepository::class);
        $this->app->singleton(TagRepositoryInterface::class, TagRepository::class);
    }
}
