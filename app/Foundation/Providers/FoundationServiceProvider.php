<?php

namespace PN\Foundation\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Foundation\Http\Controllers\HomeController;
use PN\Foundation\Http\Controllers\NotificationController;
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

            \Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function () {
                \Route::get('/', ['as' => 'index','uses' => NotificationController::class . '@index']);
                \Route::get('last', ['as' => 'last','uses' => NotificationController::class . '@last']);
                \Route::patch('{id}/read', ['as' => 'markAsRead','uses' => NotificationController::class . '@markAsRead']);
                \Route::post('mark-all-read', ['as' => 'markAllRead','uses' => NotificationController::class . '@markAllRead']);
                \Route::post('{id}/dismiss', ['as' => 'dismiss','uses' => NotificationController::class . '@dismiss']);
            });
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
