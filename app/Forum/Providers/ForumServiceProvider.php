<?php

namespace PN\Forum\Providers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use PN\Forum\Http\Middleware\ForumAPIAuth;
use PN\Forum\Post;
use PN\Forum\Repositories\PostRepository;
use PN\Forum\Repositories\PostRepositoryInterface;
use PN\Forum\Thread;
use PN\Forum\PostObserver;
use PN\Forum\ThreadObserver;
use PN\Foundation\Providers\CompileHelperTrait;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap the application events.
     *
     * @param  Router  $router
     * @param  GateContract  $gate
     * @return void
     */
    public function boot(Router $router, GateContract $gate)
    {
        $this->observeModels();

        $this->registerPolicies();

        if (config('forum.routing.enabled')) {
            $this->registerMiddleware($router);
        }
    }

    /**
     * Initialise model observers.
     *
     * @return void
     */
    protected function observeModels()
    {
        Thread::observe(new ThreadObserver);
        Post::observe(new PostObserver);
    }

    /**
     * Register the package policies.
     *
     * @param  GateContract  $gate
     * @return void
     */
    public function registerPolicies()
    {
        $forumPolicy = config('forum.integration.policies.forum');
        foreach (get_class_methods(new $forumPolicy()) as $method) {
            \Gate::define($method, "{$forumPolicy}@{$method}");
        }

        foreach (config('forum.integration.policies.model') as $model => $policy) {
            \Gate::policy($model, $policy);
        }
    }

    /**
     * Register middleware.
     *
     * @return void
     */
    public function registerMiddleware(Router $router)
    {
        $router->middleware('forum.api.auth', ForumAPIAuth::class);
    }

    public static function compiles() {
        $files = [];

        $files = array_merge($files, CompileHelperTrait::filesInFolder(app_path('Forum/Providers')));

        return $files;
    }
}
