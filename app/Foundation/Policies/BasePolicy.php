<?php


namespace PN\Foundation\Policies;


class BasePolicy
{
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}