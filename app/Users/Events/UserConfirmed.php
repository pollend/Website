<?php

namespace PN\Users\Events;


use PN\Events\Event;
use PN\Users\User;

class UserConfirmed extends Event
{
    /**
     * @var User
     */
    public $user;

    /**
     * UserRegistered constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
