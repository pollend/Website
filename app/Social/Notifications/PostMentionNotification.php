<?php

namespace PN\Social\Notifications;

use Illuminate\Notifications\Notification;
use PN\Assets\Asset;
use PN\Forum\Post;
use PN\Users\User;

class PostMentionNotification extends Notification
{
    /**
     * @var User
     */
    private $poster;

    /**
     * @var Asset
     */
    private $post;

    /**
     * Create a new notification instance.
     * @param User $poster
     * @param Post $post
     */
    public function __construct(User $poster, Post $post)
    {
        $this->poster = $poster;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'database',
//            'broadcast'
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'text' => sprintf("%s mentioned you", $this->poster->getPresenter()->displayName()),
            'url' => $this->post->url
        ];
    }
}
