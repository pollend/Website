<?php


namespace PN\Social\Jobs;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use PN\Jobs\Job;
use PN\Social\Notification;
use PN\Users\User;

/**
 * Class NotifyUser
 * @package PN\Social\Jobs
 */
class NotifyUser extends Job
{
    use SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $context;

    /**
     * NotifyUser constructor.
     * @param $user
     * @param $type
     * @param $context
     */
    public function __construct(User $user, string $type, string $context)
    {
        $this->user = $user;
        $this->type = $type;
        $this->context = $context;
    }

    public function handle()
    {
        $notification = new Notification();

        $notification->setUser($this->user);
        $notification->type = $this->type;
        $notification->context = $this->context;
        
        /**
         * temp cache the combo of comment and username so that a user doesn't get mulitple notifications if
         * another user updates the comment
         */
        $key = sprintf('notifications.notified.%s', md5($notification->getUser()->id . $notification->context));

        if (!\Cache::has($key)) {
            \Cache::put($key, true, 86400); // 1 day

            \NotificationRepo::add($notification);
        }
    }
}