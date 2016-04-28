<?php

namespace PN\Forum\Listeners;

use Illuminate\Contracts\Auth\Guard;
use PN\Forum\Events\UserViewingThread;

class MarkThreadAsRead
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * Create the event listener.
     *
     * @param  Guard  $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle the event.
     *
     * @param  UserViewingThread  $event
     * @return void
     */
    public function handle(UserViewingThread $event)
    {
        if ($this->auth->check()) {
            $primaryKey = $this->auth->user()->getKeyName();
            $event->thread->markAsRead($this->auth->user()->{$primaryKey});
        }
    }
}
