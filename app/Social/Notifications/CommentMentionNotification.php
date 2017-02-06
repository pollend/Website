<?php


namespace PN\Social\Notifications;



use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use PN\Social\Comment;
use PN\Users\User;

class CommentMentionNotification extends Notification
{
    use Queueable;

    protected  $comment ;
    protected $mentionedUser ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment,User $mentionedUser)
    {
        $this->mentionedUser = $mentionedUser;
        $this->comment = $comment;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', WebPushChannel::class];
    }


    public  function toArray($notifiable)
    {
        return [
            'title' => 'Someone Mentioned You!',
            'body' => $this->getText(),
            'action_url' => $this->getFinalUrl(),
            'created' => Carbon::now()->toIso8601String()
        ];
    }

    /**
     * Get the web push representation of the notification.
     *
     * @param  mixed  $notifiable
     * @param  mixed  $notification
     * @return WebPushMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        return WebPushMessage::create()
            ->id($notification->id)
            ->title('Someone Mentioned You!')
            ->icon('/notification-icon.png')
            ->body($this->getText())
            ->action('url', $this->getFinalUrl());
    }


    /**
     * Returns the human readable text for this notification
     *
     * @return string
     */
    public function getText() : string
    {
        return sprintf("%s mentioned you in a comment of %s", $this->mentionedUser->getPresenter()->displayName(), $this->comment->getAsset()->name);
    }

    /**
     * Returns the url to where this notification was triggered
     *
     * @return string
     */
    public function getFinalUrl() : string
    {
        return $this->comment->getPresenter()->url;
    }
}