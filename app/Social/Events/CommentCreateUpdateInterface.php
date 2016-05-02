<?php


namespace PN\Social\Events;


use PN\Social\Comment;

interface CommentCreateUpdateInterface
{
    /**
     * @return Comment
     */
    public function getComment() : Comment;
}