<?php

namespace PN\Social\Jobs;


use PN\Jobs\Job;
use PN\Social\Comment;
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
     * @var string
     */
    private $body;

    /**
     * CreateComment constructor.
     * @param $user
     * @param $body
     */
    public function __construct(User $user, string $body)
    {
        $this->user = $user;
        $this->body = $body;
    }

    /**
     * @return Comment
     */
    public function handle() : Comment
    {
        $comment = new Comment();

        $comment->setUser($this->user);
        $comment->body = $this->body;

        $comment->save();

        return $comment;
    }


}
