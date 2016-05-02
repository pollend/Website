<?php

namespace PN\Forum\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use PN\Forum\Events\UserCreatedPost;
use PN\Forum\Events\UserUpdatedPost;
use PN\Forum\Events\UserViewingThread;
use PN\Forum\Forum;
use PN\Forum\Listeners\MarkThreadAsRead;
use PN\Forum\Listeners\RegisterView;
use PN\Social\Listeners\ScanPostForMentionsListener;

class ForumFrontendServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserViewingThread::class => [
            MarkThreadAsRead::class,
            RegisterView::class
        ],
        UserCreatedPost::class => [
            ScanPostForMentionsListener::class
        ],
        UserUpdatedPost::class => [
            ScanPostForMentionsListener::class
        ]
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFacades();
    }

    /**
     * Bootstrap the application events.
     *
     * @param  Router  $router
     * @param  DispatcherContract  $events
     * @return void
     */
    public function boot(Router $router, DispatcherContract $events)
    {
        $this->registerListeners($events);
    }

    /**
     * Register the package listeners.
     *
     * @param  DispatcherContract  $events
     * @return void
     */
    public function registerListeners(DispatcherContract $events)
    {
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    /**
     * Register the package facades.
     *
     * @return void
     */
    public function registerFacades()
    {
        // Bind the forum facade
        $this->app->bind('forum', function()
        {
            return new Forum;
        });

        // Create facade alias
        $loader = AliasLoader::getInstance();
        $loader->alias('Forum', 'ParkitectNexus\Facades\Forum');
    }
}
