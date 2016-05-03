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
        \Route::group(['middleware' => ['web']], function(){
            \Route::get('', [
                'as' => 'home.index',
                'uses' => HomeController::class . '@getIndex'
            ]);
        });
    }

    public static function compiles() {
        $files = [];

        $files = array_merge($files, CompileHelperTrait::filesInFolder(app_path('Foundation/Providers')));

        return $files;
    }
}
