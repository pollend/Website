<?php
namespace PN\Forum\Listeners;

use ParkitectNexus\Notifications\Forum\UserMentionedUser;
use ParkitectNexus\Repositories\NotificationRepositoryInterface;
use ParkitectNexus\Repositories\UserRepositoryInterface;

/**
 * Class NotifyUserOfMention
 * @package ParkitectNexus\Listeners\Comment
 */
class NotifyUserOfMention
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var NotificationRepositoryInterface
     */
    private $notificationRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param NotificationRepositoryInterface $notificationRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->userRepository = $userRepository;
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * @param $event
     */
    public function handle($event)
    {
        preg_match_all('/[\@]([a-zA-Z0-9-]+)/', $event->post->content, $users);

        foreach ($users[1] as $username) {
            /**
             * temp cache the combo of comment and username so that a user doesn't get mulitple notifications if
             * another user updates the comment
             */
            $key = "post.mentions.{$event->post->id}.$username";
            if (!\Cache::has($key)) {
                \Cache::put($key, true, 60 * 60 * 6); // 6 hours

                try {
                    $user = $this->userRepository->findByUsername($username);

                    $notification = new UserMentionedUser($event->post->user, $user, $event->post);

                    $this->notificationRepository->createFromNotification($notification);
                } catch (\Exception $e) {
                    // ignore
                }
            }

        }
    }
}
