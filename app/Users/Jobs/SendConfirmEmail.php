<?php

namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\Repositories\UserRepositoryInterface;

class SendConfirmEmail extends Job
{
    private $userId;

    private $userRepo;

    /**
     * SendConfirmEmail constructor.
     * @param $userId
     * @param $userRepo
     */
    public function __construct($userId, UserRepositoryInterface $userRepo)
    {
        $this->userId = $userId;
        $this->userRepo = $userRepo;
    }

    public function handle()
    {
        $user = $this->userRepo->find($this->userId);

        // only send confirmation mails to non social unconfirmed accounts
        if($user->confirmed == 0) {
            \Mail::send('auth.emails.confirm', ['user' => $user], function ($m) use ($user) {
                $m->from('info@parkitectnexus.com', 'ParkitectNexus');

                $m->to($user->email, $user->presenter()->displayName)->subject('Confirm your account on ParkitectNexus');
            });
        }
    }
}
