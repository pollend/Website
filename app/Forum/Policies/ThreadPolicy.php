<?php

namespace PN\Forum\Policies;

use PN\Forum\Thread;

class ThreadPolicy
{
    /**
     * Permission: Delete posts in thread.
     *
     * @param  object $user
     * @param  Thread $thread
     * @return bool
     */
    public function deletePosts($user, Thread $thread)
    {
        return $user->isModerator();
    }

    /**
     * Permission: Rename thread.
     *
     * @param  object $user
     * @param  Thread $thread
     * @return bool
     */
    public function rename($user, Thread $thread)
    {
        return $user->id == $thread->user_id || $user->isModerator();
    }

    /**
     * Permission: Reply to thread.
     *
     * @param  object $user
     * @param  Thread $thread
     * @return bool
     */
    public function reply($user, Thread $thread)
    {
        return !$thread->locked || $user->isModerator();
    }

    /**
     * Permission: Delete thread.
     *
     * @param  object $user
     * @param  Thread $thread
     * @return bool
     */
    public function delete($user, Thread $thread)
    {
        return $user->id == $thread->user_id || $user->isModerator();
    }
}
