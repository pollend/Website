<?php

namespace PN\Foundation\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Foundation\Http\Controllers\HomeController;

class FoundationServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \Route::controller('', HomeController::class, [
            'getIndex' => 'home.index'
        ]);
    }
}
