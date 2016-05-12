<?php


namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\User;

class SetSteamIdOnUser extends Job
{
    private $user;

    private $steamID;

    /**
     * SetSteamIdOnUser constructor.
     * @param $user
     * @param $steamID
     */
    public function __construct(User $user, string $steamID)
    {
        $this->user = $user;
        $this->steamID = $steamID;
    }

    public function handle()
    {
        $this->user->steam_id = $this->steamID;

        \UserRepo::edit($this->user);
    }
}