<?php

namespace PN\Social\Jobs;


use PN\Assets\Asset;
use PN\Jobs\Job;
use PN\Social\Comment;
use PN\Social\Events\CommentWasCreated;
use PN\Users\User;

/**
 * Class CreateComment
 * @package PN\Social\Jobs
 */
class CreateComment extends Job
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var string
     */
    private $body;

    /**
     * CreateComment constructor.
     * @param $user
     * @param $body
     */
    public function __construct(User $user, Asset $asset, string $body)
    {
        $this->user = $user;
        $this->asset = $asset;
        $this->body = $body;
    }

    /**
     * @return Comment
     */
    public function handle() : Comment
    {
        $comment = new Comment();

        $comment->setUser($this->user);
        $comment->setAsset($this->asset);
        $comment->body = $this->body;

        \CommentRepo::add($comment);

        event(new CommentWasCreated($comment));

        return $comment;
    }


}
