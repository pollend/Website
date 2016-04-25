<?php


namespace PN\Social\Events;


use PN\Events\Event;
use PN\Social\Comment;

/**
 * Class CommentWasCreated
 * @package PN\Social\Events
 */
class CommentWasCreated extends Event
{
    /**
     * @var Comment
     */
    public $comment;

    /**
     * CommentWasCreated constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}