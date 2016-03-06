<?php

namespace PN\Users\Events;


use PN\Events\Event;
use PN\Users\User;

/**
 * Class UserRegistered
 * @package PN\Users\Events
 */
class UserRegistered extends Event
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
