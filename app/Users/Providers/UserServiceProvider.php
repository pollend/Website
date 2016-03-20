<?php

namespace PN\Users\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PN\Users\Events\UserRegistered;
use PN\Users\Http\Controllers\UserController;
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
        \Route::get('users/{identifier}', [
            'as' => 'users.profile',
            'uses' => UserController::class.'@profile'
        ]);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
