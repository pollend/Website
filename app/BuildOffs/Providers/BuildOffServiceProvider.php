<?php

namespace PN\BuildOffs\Providers;


use Illuminate\Support\ServiceProvider;
use PN\BuildOffs\Http\Controllers\BuildOffController;
use PN\BuildOffs\Repositories\BuildOffRepository;
use PN\BuildOffs\Repositories\BuildOffRepositoryInterface;
use PN\BuildOffs\Repositories\RankRepository;
use PN\BuildOffs\Repositories\RankRepositoryInterface;
use PN\Foundation\Providers\CompileHelperTrait;

class BuildOffServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $router = $this->app['router'];

        $router->get('build-offs', [
            'uses' => BuildOffController::class.'@index',
            'as' => 'buildoffs.index'
        ]);

        $router->get('build-offs/{id}/{slug}', [
            'uses' => BuildOffController::class.'@show',
            'as' => 'buildoffs.show'
        ]);

        $this->app->singleton(BuildOffRepositoryInterface::class, BuildOffRepository::class);
        $this->app->singleton(RankRepositoryInterface::class, RankRepository::class);
    }

    public static function compiles() {
        $files = [];

        $files = array_merge($files, CompileHelperTrait::filesInFolder(app_path('BuildOffs/Providers')));

        return $files;
    }
}
