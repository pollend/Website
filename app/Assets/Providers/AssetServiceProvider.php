<?php

namespace PN\Assets\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Assets\Http\Controllers\Api\ApiAssetController;
use PN\Assets\Http\Controllers\Api\ApiAssetManageController;
use PN\Assets\Http\Controllers\AssetController;
use PN\Assets\Http\Controllers\AssetManageController;
use PN\Assets\Repositories\AssetRepository;
use PN\Assets\Repositories\AssetRepositoryInterface;
use PN\Assets\Repositories\TagRepository;
use PN\Assets\Repositories\TagRepositoryInterface;
use PN\Foundation\Providers\CompileHelperTrait;

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
                'getSelectMod' => 'assets.manage.selectmod',
                'getSelectFile' => 'assets.manage.selectfile',
                'getCreate' => 'assets.manage.create',
                'getUpdate' => 'assets.manage.update',
                'deleteDelete' => 'assets.manage.delete'
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

            $router->get('assets/{identifier}/{slug}', [
                'uses' => AssetController::class . '@getShow',
                'as' => 'assets.show'
            ]);

            $router->resource('api/assets', ApiAssetController::class);
        });

        $router->controller('api/assets/manage', ApiAssetManageController::class);

        $this->app->singleton(AssetRepositoryInterface::class, AssetRepository::class);
        $this->app->singleton(TagRepositoryInterface::class, TagRepository::class);
    }

    public static function compiles()
    {
        $files = [];

        $files = array_merge($files, CompileHelperTrait::filesInFolder(app_path('Assets/Providers')));

        return $files;
    }
}
