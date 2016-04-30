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
        \Route::group(['middleware' => ['web']], function () {
            \Route::controller('assets/manage', AssetManageController::class, [
                'getSelectFile' => 'assets.manage.selectfile',
                'postSelectFile' => 'assets.manage.selectfile',
                'getCreate' => 'assets.manage.create',
            ]);
            \Route::get('assets/{type}', [
                'as' => 'assets.filter',
                'uses' => AssetController::class . '@filterPage'
            ]);
            \Route::get('assets/download/{identifier}', [
                'as' => 'assets.download',
                'uses' => AssetController::class . '@download'
            ]);
            \Route::get('assets/{type}/filter', [
                'as' => 'assets.filter.list',
                'uses' => AssetController::class . '@filterAssets'
            ]);

            \Route::controller('assets', AssetController::class, [
                'getShow' => 'assets.show',
            ]);

        });

        $this->app->singleton(AssetRepositoryInterface::class, AssetRepository::class);
        $this->app->singleton(TagRepositoryInterface::class, TagRepository::class);
    }
}
