<?php

namespace PN\Social\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use PN\Providers\AuthServiceProvider;
use PN\Social\Comment;
use PN\Social\Http\Controllers\CommentController;
use PN\Social\Policies\CommentPolicy;
use PN\Social\Repositories\CommentRepository;
use PN\Social\Repositories\CommentRepositoryInterface;

class CommentServiceProvider extends AuthServiceProvider
{
    protected $policies = [
        Comment::class => CommentPolicy::class,
    ];

    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \Route::group(['middleware' => ['web']], function () {
            \Route::resource('comments', CommentController::class);
        });

        $this->app->singleton(CommentRepositoryInterface::class, CommentRepository::class);
    }
}
