<?php


namespace PN\Social\Listeners;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Social\Events\UserCommentedOnAsset;
use PN\Social\Jobs\NotifyUser;
use PN\Social\Notifications\CommentOnAssetNotification;
use PN\Social\Notifications\NewCommentOnAsset;

/**
 * Class NotifyUserOfCommentListener
 * @package PN\Assets\Listeners
 */
class NotifyUserOfCommentListener
{
    use DispatchesJobs;

    /**
     * @param UserCommentedOnAsset $event
     */
    public function handle(UserCommentedOnAsset $event)
    {
        $user = $event->comment->getAsset()->getUser();

        if($user->id != $event->user->id) {
            $user->notify(new NewCommentOnAsset($event->user, $event->comment->getAsset()));
        }
    }
}