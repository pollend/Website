<?php

namespace PN\Forum\Listeners;

use ParkitectNexus\Models\User\Subscription;
use ParkitectNexus\Notifications\UserCreatedPost;
use ParkitectNexus\Repositories\Criteria\Subscriptions\SubscribableCriteria;
use ParkitectNexus\Repositories\NotificationRepositoryInterface;
use ParkitectNexus\Repositories\UserSubscriptionRepositoryInterface;

class NotifyUserOfPost
{
    private $notificationRepository;

    private $subscriptionRepository;

    /**
     * NotifyUserOfPost constructor.
     * @param $notificationRepository
     */
    public function __construct(NotificationRepositoryInterface $notificationRepository, UserSubscriptionRepositoryInterface $subscriptionRepository)
    {
        $this->notificationRepository = $notificationRepository;
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function handle($event)
    {
        $post = $event->post;

        $subscriptions = $this->subscriptionRepository->getByCriteria(new SubscribableCriteria($post->thread->id, get_class($post->thread)));

        foreach ($subscriptions as $subscription) {
            try {
                $user = $subscription->user;

                if($user->id != $event->post->user->id){
                    $notification = new UserCreatedPost($event->post->user, $user, $event->post);

                    $this->notificationRepository->createFromNotification($notification);
                }
            } catch (\Exception $e) {
                // ignore
            }
        }
    }
}
