<?php

namespace PN\Users\Jobs;

use PN\Jobs\Job;
use PN\Users\User;

/**
 * Class SetSocialMedia
 * @package PN\Users\Jobs
 */
class SetSocialMedia extends Job {
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $twitter;

    /**
     * @var string
     */
    private $twitch;

    /**
     * @var string
     */
    private $steam;

    /**
     * SetSocialMedia constructor.
     * @param User $user
     * @param string $twitter
     * @param string $twitch
     * @param string $steam
     */
    public function __construct(User $user, string $twitter, string $twitch, string $steam)
    {
        $this->user = $user;
        $this->twitter = $twitter;
        $this->twitch = $twitch;
        $this->steam = $steam;
    }

    public function handle()
    {
        $this->user->twitter = $this->twitter;
        $this->user->twitch = $this->twitch;
        $this->user->steam = $this->steam;

        \UserRepo::edit($this->user);
    }
}