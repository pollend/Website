<?php

namespace PN\Users\Events;


use PN\Events\Event;

class UsernameSet extends Event
{
    public $user;

    /**
     * UsernameSet constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
