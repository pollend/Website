<?php


namespace PN\Social\Providers;


use Illuminate\Support\ServiceProvider;
use PN\Social\Http\Controllers\NotificationController;
use PN\Social\Repositories\NotificationRepository;
use PN\Social\Repositories\NotificationRepositoryInterface;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $router = $this->app['router'];

        $router->get('notifications/redirect/{id}', [
            'uses' => NotificationController::class . '@redirect',
            'as' => 'notifications.redirect'
        ]);
        
        $this->app->singleton(NotificationRepositoryInterface::class, NotificationRepository::class);
    }
}