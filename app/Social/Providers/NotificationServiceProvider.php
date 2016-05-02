<?php


namespace PN\Social\Providers;


use Illuminate\Support\ServiceProvider;
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
        $this->app->singleton(NotificationRepositoryInterface::class, NotificationRepository::class);
    }
}