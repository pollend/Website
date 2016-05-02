<?php


namespace PN\Social\Events;


use PN\Assets\Asset;
use PN\Users\User;

/**
 * Class UserCommentedOnAsset
 * @package PN\Assets\Events
 */
class UserCommentedOnAsset
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var Asset
     */
    public $asset;

    /**
     * UserCommentedOnAsset constructor.
     * @param User $user
     * @param Asset $asset
     */
    public function __construct(User $user, Asset $asset)
    {
        $this->user = $user;
        $this->asset = $asset;
    }
}