<?php


namespace PN\Media\Policies;


use PN\Foundation\Policies\BasePolicy;
use PN\Media\Screenshot;
use PN\Users\User;

class ScreenshotPolicy extends BasePolicy
{
    public function update(User $user, Screenshot $screenshot)
    {
        return $user->id == $screenshot->getUser()->id;
    }

    public function delete(User $user, Screenshot $screenshot)
    {
        return $user->id == $screenshot->getUser()->id;
    }
}