<?php

namespace PN\Foundation\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Foundation\Http\Controllers\HomeController;
use PN\Foundation\Repositories\OptionRepository;
use PN\Foundation\Repositories\OptionRepositoryInterface;

class FoundationServiceProvider extends ServiceProvider
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
            $router->get('', [
                'as' => 'home.index',
                'uses' => HomeController::class . '@getIndex'
            ]);
        });

        $router->post('modding-wiki/', '\Ikkentim\WikiClone\Http\Controllers\WebhookController@trigger');
        $router->get('modding-wiki/{page?}', '\Ikkentim\WikiClone\Http\Controllers\DocumentationController@index');

        $this->app->singleton(OptionRepositoryInterface::class, OptionRepository::class);
    }

    public static function compiles()
    {
        $files = [];

        $files = array_merge($files, CompileHelperTrait::filesInFolder(app_path('Foundation/Providers')));

        return $files;
    }
}
