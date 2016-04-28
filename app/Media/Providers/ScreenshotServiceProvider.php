<?php


namespace PN\Media\Providers;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use PN\Media\Http\Controllers\Api\ApiScreenshotController;
use PN\Media\Http\Controllers\ScreenshotController;
use PN\Media\Policies\ScreenshotPolicy;
use PN\Media\Repositories\ScreenshotRepository;
use PN\Media\Repositories\ScreenshotRepositoryInterface;
use PN\Media\Screenshot;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class ScreenshotServiceProvider extends AuthServiceProvider
{
    protected $policies = [
        Screenshot::class => ScreenshotPolicy::class
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ScreenshotRepositoryInterface::class, ScreenshotRepository::class);

        $router = $this->app['router'];

        $router->group(['middleware' => 'web'], function() use ($router) {
            $router->get('screenshots', [
                'uses' => ScreenshotController::class.'@index',
                'as' => 'screenshots.index'
            ]);

            $router->get('screenshots/{identifier}/edit', [
                'uses' => ScreenshotController::class.'@edit',
                'as' => 'screenshots.edit'
            ]);

            $router->put('screenshots/{identifier}', [
                'uses' => ScreenshotController::class.'@update',
                'as' => 'screenshots.update'
            ]);

            $router->delete('screenshots/{identifier}', [
                'uses' => ScreenshotController::class.'@delete',
                'as' => 'screenshots.delete'
            ]);

            $router->get('screenshots/random', [
                'uses' => ScreenshotController::class.'@random',
                'as' => 'screenshots.random'
            ]);

            $router->get('screenshots/{identifier}/{slug}', [
                'uses' => ScreenshotController::class.'@show',
                'as' => 'screenshots.show'
            ]);
        });

        $router->post('/api/screenshot/create', [
            'uses' => ApiScreenshotController::class . '@create'
        ]);
    }

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
    }
}