<?php


namespace PN\Social\Notifications;


/**
 * Class PostMentionNotification
 * @package PN\Social\Notifications
 */
class PostMentionNotification extends AbstractNotification
{
    /**
     * Returns the human readable text for this notification
     *
     * @return string
     */
    public function getText() : string
    {
        $context = json_decode($this->notification->context);

        $post = \PostRepo::find($context->post_id);
        $user = $post->getUser();

        return sprintf("%s mentioned you in %s", $user->getPresenter()->displayName(), $post->getThread()->title);
    }

    /**
     * Returns the url to where this notification was triggered
     *
     * @return string
     */
    public function getFinalUrl() : string
    {
        $context = json_decode($this->notification->context);

        $post = \PostRepo::find($context->post_id);

        return $post->url;
    }
}