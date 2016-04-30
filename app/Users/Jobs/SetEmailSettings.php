<?php


namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\User;

/**
 * Class SetEmailSettings
 * @package PN\Users\Jobs
 */
class SetEmailSettings extends Job
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $notificationRate;

    /**
     * @var string
     */
    private $recapRate;

    /**
     * SetEmailSettings constructor.
     * @param User $user
     * @param string $notificationRate
     * @param string $recapRate
     */
    public function __construct(User $user, string $notificationRate, string $recapRate)
    {
        $this->user = $user;
        $this->notificationRate = $notificationRate;
        $this->recapRate = $recapRate;
    }

    public function handle()
    {
        $this->user->notification_rate = $this->notificationRate;
        $this->user->recap_rate = $this->recapRate;

        \UserRepo::edit($this->user);
    }
}