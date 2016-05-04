<?php


namespace PN\Social\Notifications;


class CommentOnAssetNotification extends AbstractNotification
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

        $asset = $comment->getAsset();
        $user = $comment->getUser();

        return sprintf("%s commented on %s", $user->getPresenter()->displayName(), $asset->name);
    }

    /**
     * Returns the url to where this notification was triggered
     *
     * @return string
     */
    public function getFinalUrl() : string
    {
        $context = json_decode($this->notification->context);

        $comment = \CommentRepo::find($context->comment_id);

        $asset = $comment->getAsset();

        return $asset->getPresenter()->url();
    }
}