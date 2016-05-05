<?php

namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\Repositories\UserRepositoryInterface;
use PN\Users\User;

class SendConfirmEmail extends Job
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $user = $this->user;
        
        // only send confirmation mails to non social unconfirmed accounts
        if($user->confirmed == 0) {
            \Mail::send('auth.emails.confirm', ['user' => $user], function ($m) use ($user) {
                $m->from('info@parkitectnexus.com', 'ParkitectNexus');

                $m->to($user->email, $user->getPresenter()->displayName)->subject('Confirm your account on ParkitectNexus');
            });
        }
    }
}
