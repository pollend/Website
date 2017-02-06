<?php


namespace PN\Social\Notifications;



use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class CommentMentionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', WebPushChannel::class];
    }


    public  function toArray($notifiable)
    {
        return [
            'title' => 'Someone Mentioned You!',
            'body' => 'Thank you for using our application.',
            'action_url' => 'https://laravel.com',
            'created' => Carbon::now()->toIso8601String()
        ];
    }

    /**
     * Get the web push representation of the notification.
     *
     * @param  mixed  $notifiable
     * @param  mixed  $notification
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        return WebPushMessage::create()
            ->id($notification->id)
            ->title('Hello from Laravel!')
            ->icon('/notification-icon.png')
            ->body('Thank you for using our application.')
            ->action('View app', 'view_app');
    }


    /**
     * Returns the human readable text for this notification
     *
     * @return string
     */
//    public function getText() : string
//    {
//        $context = json_decode($this->notification->context);
//
//
//        $comment = \CommentRepo::find($context->comment_id);
//        $user = $comment->getUser();
//
//        return sprintf("%s mentioned you in a comment of %s", $user->getPresenter()->displayName(), $comment->getAsset()->name);
//    }
//
//    /**
//     * Returns the url to where this notification was triggered
//     *
//     * @return string
//     */
//    public function getFinalUrl() : string
//    {
//        $context = json_decode($this->notification->context);
//
//        $comment = \CommentRepo::find($context->comment_id);
//
//        return $comment->getPresenter()->url();
//    }
}