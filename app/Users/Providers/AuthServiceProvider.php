<?php

namespace PN\Users\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PN\Users\Events\UserRegistered;
use PN\Users\Http\Controllers\AuthController;
use PN\Users\Http\Controllers\SocialAuthController;
use PN\Users\Http\Controllers\SteamController;
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
        \Route::group(['middleware' => ['web']], function () {
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
                'getSteam' => 'socialauth.steam',
                'getGoogleCallback' => 'socialauth.google.callback',
                'getFacebookCallback' => 'socialauth.facebook.callback',
                'getGithubCallback' => 'socialauth.github.callback',
                'getSteamCallback' => 'socialauth.steam.callback',
                'getSetUsername' => 'socialauth.setusername',
                'postSetUsername' => 'socialauth.setusername',
            ]);
        });
    }
}
