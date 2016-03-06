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

            \Route::controller('assets', AssetController::class, [
                'getShow' => 'assets.show',
            ]);
        });

        $this->app->bind(AssetRepositoryInterface::class, AssetRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
    }
}
