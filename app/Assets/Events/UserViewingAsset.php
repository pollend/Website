<?php


namespace PN\Assets\Events;


use PN\Assets\Asset;
use PN\Events\Event;
use PN\Users\User;

/**
 * Class UserViewingAsset
 * @package PN\Assets\Events
 */
class UserViewingAsset extends Event
{
    /**
     * @var Asset
     */
    public $asset;

    /**
     * @var User|null
     */
    public $user;

    /**
     * UserViewingAsset constructor.
     * @param Asset $asset
     * @param User|null $user
     */
    public function __construct(Asset $asset, $user)
    {
        $this->asset = $asset;
        $this->user = $user;
    }
}