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
        if($event->user->social == 0) {
            \Notification::info('Check your email to confirm your account');
            $this->dispatch(new SendConfirmEmail($event->user));
        }
    }
}
