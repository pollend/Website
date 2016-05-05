<?php

namespace PN\Users\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PN\Users\Events\UserRegistered;
use PN\Users\Http\Controllers\AuthController;
use PN\Users\Http\Controllers\SocialAuthController;
use PN\Users\Listeners\ConfirmWhenInDev;
use PN\Users\Listeners\EmailConfirm;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegistered::class => [
            EmailConfirm::class,
            ConfirmWhenInDev::class
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \Route::group(['middleware' => ['web']], function(){
            \Route::controller('auth', AuthController::class, [
                'getLogin' => 'auth.login',
                'postLogin' => 'auth.login',
                'getRegister' => 'auth.register',
                'postRegister' => 'auth.register',
                'getForgotPassword' => 'auth.forgotpassword',
                'postForgotPassword' => 'auth.forgotpassword',
                'getSetNewPassword' => 'auth.newpassword',
                'postSetNewPassword' => 'auth.newpassword',
                'getLogout' => 'auth.logout',
                'getConfirm' => 'auth.confirm',
            ]);

            \Route::controller('social-auth', SocialAuthController::class, [
                'getGoogle' => 'socialauth.google',
                'getFacebook' => 'socialauth.facebook',
                'getGithub' => 'socialauth.github',
                'getGoogleCallback' => 'socialauth.google.callback',
                'getFacebookCallback' => 'socialauth.facebook.callback',
                'getGithubCallback' => 'socialauth.github.callback',
                'getSetUsername' => 'socialauth.setusername',
                'postSetUsername' => 'socialauth.setusername',
            ]);
        });
//        \Route::get('/auth/login', [
//            'as' => 'auth.login',
//            'uses' => '\PN\Users\Http\Controllers\AuthController@getLogin'
//        ]);
//        \Route::post('/auth/login', [
//            'as' => 'auth.login',
//            'uses' => '\PN\Users\Http\Controllers\AuthController@postLogin'
//        ]);
//
//        \Route::get('/auth/logout', [
//            'as' => 'auth.logout',
//            'uses' => '\PN\Users\Http\Controllers\AuthController@getLogout'
//        ]);
//        \Route::get('/auth/set-username/{identifier}',
//            ['as' => 'auth.setusername', 'uses' => '\PN\Users\Http\Controllers\AuthController@setUsername']);
//        \Route::post('/auth/store-username/{identifier}',
//            ['as' => 'auth.storeusername', 'uses' => '\PN\Users\Http\Controllers\AuthController@storeUsername']);
//
//        \Route::get('/auth/register', ['as' => 'auth.register', 'uses' => '\PN\Users\Http\Controllers\AuthController@getRegister']);
//        \Route::post('/auth/register', '\PN\Users\Http\Controllers\AuthController@postRegister');
//        \Route::get('/auth/confirm/{token}',
//            ['as' => 'auth.confirm', 'uses' => '\PN\Users\Http\Controllers\AuthController@confirm']);
//        \Route::get('/auth/resend/{email}',
//            ['as' => 'auth.resend', 'uses' => '\PN\Users\Http\Controllers\AuthController@resend']);
//
//        \Route::get('/auth/request-password',
//            [
//                'as' => 'auth.requestpassword',
//                'uses' => '\PN\Users\Http\Controllers\AuthController@getRequestNewPassword'
//            ]);
//        \Route::post('/auth/request-password',
//            [
//                'as' => 'auth.requestpassword',
//                'uses' => '\PN\Users\Http\Controllers\AuthController@postRequestNewPassword'
//            ]);
//
//        \Route::get('/auth/new-password/{token}',
//            ['as' => 'auth.newpassword', 'uses' => '\PN\Users\Http\Controllers\AuthController@getSetNewPassword']);
//        \Route::post('/auth/new-password/{token}',
//            ['as' => 'auth.newpassword', 'uses' => '\PN\Users\Http\Controllers\AuthController@postSetNewPassword']);
    }
}
