<?php

namespace PN\Forum\Policies;

use PN\Forum\Post;

class PostPolicy
{
    /**
     * Permission: Edit post.
     *
     * @param  object $user
     * @param  Post $post
     * @return bool
     */
    public function edit($user, Post $post)
    {
        return $user->id == $post->user_id || $user->isModerator();
    }

    /**
     * Permission: Delete post.
     *
     * @param  object $user
     * @param  Post $post
     * @return bool
     */
    public function delete($user, Post $post)
    {
        return $user->id == $post->user_id || $user->isModerator();
    }
}
