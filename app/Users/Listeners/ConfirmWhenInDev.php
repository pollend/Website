<?php


namespace PN\Users\Listeners;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Users\Events\UserRegistered;
use PN\Users\Jobs\ConfirmUser;

class ConfirmWhenInDev
{
    use DispatchesJobs;
    
    public function handle(UserRegistered $event)
    {
        if(env('APP_DEBUG')) {
            $this->dispatch(new ConfirmUser($event->user));
        }
    }
}