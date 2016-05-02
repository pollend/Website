<?php


namespace PN\Social\Events;


use PN\Events\Event;
use PN\Social\Comment;

/**
 * Class CommentWasUpdated
 * @package PN\Social\Events
 */
class CommentWasUpdated extends Event implements CommentCreateUpdateInterface
{
    /**
     * @var Comment
     */
    public $comment;

    /**
     * CommentWasUpdated constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return Comment
     */
    public function getComment() : Comment
    {
        return $this->comment;
    }
}