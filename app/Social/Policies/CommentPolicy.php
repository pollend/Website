<?php


namespace PN\Social\Policies;


use PN\Foundation\Policies\BasePolicy;
use PN\Social\Comment;
use PN\Users\User;

class CommentPolicy extends BasePolicy
{
    public function update(User $user, Comment $comment)
    {
        return $comment->getUser()->id == $user->id;
    }
}