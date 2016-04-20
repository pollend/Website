<?php

namespace PN\Users\Listeners;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Users\Events\UserRegistered;
use PN\Users\Jobs\SendConfirmEmail;

class EmailConfirm
{
    use DispatchesJobs;

    public function handle(UserRegistered $event)
    {
        if($event->user->social == 0 && !env('APP_DEBUG')) {
            $this->dispatch(app(SendConfirmEmail::class, [$event->user->id]));
        }
    }
}
