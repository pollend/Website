<?php

namespace PN\Users\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PN\Users\Events\UserRegistered;
use PN\Users\Http\Controllers\UserProfileController;
use PN\Users\Jobs\SendConfirmEmail;
use PN\Users\Listeners\EmailConfirm;
use PN\Users\Repositories\UserRepository;
use PN\Users\Repositories\UserRepositoryInterface;

class UserServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

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
        $router = $this->app['router'];

        $router->get('users/{username}', [
            'as' => 'users.show',
            'uses' => UserProfileController::class.'@show'
        ]);

        $router->get('users/uploads/{username}', [
            'as' => 'users.uploads',
            'uses' => UserProfileController::class.'@uploads'
        ]);

        $router->get('users/downloads/{username}', [
            'as' => 'users.downloads',
            'uses' => UserProfileController::class.'@downloads'
        ]);

        $router->get('users/views/{username}', [
            'as' => 'users.views',
            'uses' => UserProfileController::class.'@views'
        ]);

        $router->get('users/likes/{username}', [
            'as' => 'users.likes',
            'uses' => UserProfileController::class.'@likes'
        ]);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
