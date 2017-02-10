<?php

namespace PN\Social\Notifications;

use Illuminate\Notifications\Notification;
use PN\Assets\Asset;
use PN\Users\User;

class NewCommentOnAsset extends Notification
{
    /**
     * @var User
     */
    private $commenter;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * Create a new notification instance.
     * @param User $commenter
     * @param Asset $asset
     */
    public function __construct(User $commenter, Asset $asset)
    {
        $this->commenter = $commenter;
        $this->asset = $asset;
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
            'text' => sprintf("%s commented on %s", $this->commenter->getPresenter()->displayName(), $this->asset->name),
            'url' => $this->asset->getPresenter()->url()
        ];
    }
}
