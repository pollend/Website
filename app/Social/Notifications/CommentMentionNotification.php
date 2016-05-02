<?php


namespace PN\Social\Notifications;


class CommentMentionNotification extends AbstractNotification
{
    /**
     * Returns the human readable text for this notification
     *
     * @return string
     */
    public function getText() : string
    {
        $context = json_decode($this->notification->context);

        $comment = \CommentRepo::find($context->comment_id);
        $user = $comment->getUser();

        return sprintf("%s mentioned you in a comment of %s", $user->getPresenter()->displayName(), $comment->getAsset()->name);
    }

    /**
     * Returns the url to where this notification was triggered
     *
     * @return string
     */
    public function getUrl() : string
    {
        $context = json_decode($this->notification->context);

        $comment = \CommentRepo::find($context->comment_id);

        return $comment->getPresenter()->url();
    }
}