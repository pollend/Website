<?php


namespace PN\Social\Events;


use PN\Assets\Asset;
use PN\Social\Comment;
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
    public $comment;

    /**
     * UserCommentedOnAsset constructor.
     * @param User $user
     * @param Asset $comment
     */
    public function __construct(User $user, Comment $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
    }
}