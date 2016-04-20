<?php


namespace PN\Social\Events;


use PN\Events\Event;
use PN\Social\Comment;

/**
 * Class CommentWasDeleted
 * @package PN\Social\Events
 */
class CommentWasDeleted extends Event
{
    /**
     * @var Comment
     */
    public $comment;

    /**
     * CommentWasDeleted constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}