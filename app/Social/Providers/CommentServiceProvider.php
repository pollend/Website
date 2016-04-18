<?php

namespace PN\Social\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Social\Http\Controllers\CommentController;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \Route::resource('comments', CommentController::class);
    }
}
