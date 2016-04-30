<?php


namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\User;

class SetAvatar extends Job
{
    private $user;

    private $rawImage;

    public function __construct(User $user, $rawImage)
    {
        $this->user = $user;
        $this->rawImage = $rawImage;
    }

    public function handle()
    {
        $this->user->setAvatar($this->rawImage);

        \UserRepo::edit($this->user);
    }
}