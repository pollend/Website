<?php namespace PN\Foundation\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;

class FlashNotification extends Notification
{
    use Queueable;
    public function toArray($notifiable)
    {
        return [

        ];
    }

    public function  via($notifiable)
    {
        return [WebPushChannel::class];
    }


}