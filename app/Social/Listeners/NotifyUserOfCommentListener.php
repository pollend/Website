<?php


namespace PN\Social\Listeners;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Social\Events\UserCommentedOnAsset;
use PN\Social\Jobs\NotifyUser;
use PN\Social\Notifications\CommentOnAssetNotification;

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
        $type = CommentOnAssetNotification::class;
        $context = json_encode(['comment_id' => $event->comment->id]);

        $this->dispatch(new NotifyUser($event->user, $type, $context));
    }
}