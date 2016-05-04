<?php


namespace PN\Assets\Policies;


use PN\Assets\Asset;
use PN\Users\User;

class AssetPolicy
{
    public function update(User $user, Asset $asset)
    {
        return $asset->getUser()->id == $user->id;
    }

    public function delete(User $user, Asset $asset)
    {
        return $asset->getUser()->id == $user->id;
    }
}