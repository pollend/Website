<?php


namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\User;

/**
 * Class SendNewPasswordRequestEmail
 * @package PN\Users\Jobs
 */
class SendNewPasswordRequestEmail extends Job
{
    /**
     * @var User
     */
    private $user;

    /**
     * SendNewPasswordRequestEmail constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $user = $this->user;

        \Mail::send('auth.emails.new-password', ['user' => $user], function ($mail) use ($user) {
            $mail->to($user->email, $user->name)
                ->from('info@parkitectnexus.com', 'ParkitectNexus')
                ->subject('New password request');
        });
    }
}