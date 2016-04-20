<?php


namespace PN\Social\Jobs;


use PN\Jobs\Job;
use PN\Social\Comment;
use PN\Social\Events\CommentWasDeleted;

/**
 * Class DeleteComment
 * @package PN\Social\Jobs
 */
class DeleteComment extends Job
{
    /**
     * @var Comment
     */
    private $comment;

    /**
     * DeleteComment constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function handle()
    {
        \CommentRepo::remove($this->comment);

        event(new CommentWasDeleted($this->comment));
    }
}