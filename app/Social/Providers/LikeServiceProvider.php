<?php


namespace PN\Social\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Social\Http\Controllers\Api\ApiLikeController;
use PN\Social\Repositories\LikeRepository;
use PN\Social\Repositories\LikeRepositoryInterface;

class LikeServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $router = $this->app['router'];

        $router->group(['middleware' => 'web'], function() use($router) {
            $router->post('api/likes/like/{type}/{id}', ApiLikeController::class.'@like');
            $router->delete('api/likes/unlike/{type}/{id}', ApiLikeController::class.'@unlike');
            $router->get('api/likes/{type}/{id}', ApiLikeController::class.'@likes');
        });

        $this->app->singleton(LikeRepositoryInterface::class, LikeRepository::class);
    }
}