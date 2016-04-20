<?php


namespace PN\Social\Jobs;


use PN\Social\Comment;
use PN\Social\Events\CommentWasUpdated;

/**
 * Class UpdateComment
 * @package PN\Social\Jobs
 */
class UpdateComment
{
    /**
     * @var Comment
     */
    private $comment;

    /**
     * @var string
     */
    private $body;

    /**
     * UpdateComment constructor.
     * @param $comment
     * @param $body
     */
    public function __construct(Comment $comment, string $body)
    {
        $this->comment = $comment;
        $this->body = $body;
    }

    public function handle() : Comment
    {
        $this->comment->body = $this->body;

        \CommentRepo::edit($this->comment);

        event(new CommentWasUpdated($this->comment));

        return $this->comment;
    }
}