<?php

namespace PN\Forum\Listeners;


use ParkitectNexus\Repositories\ForumPostRepositoryInterface;
use ParkitectNexus\Repositories\ViewRepositoryInterface;

/**
 * Class RegisterView
 * @package ParkitectNexus\Listeners
 */
class RegisterView
{
    public function handle($event)
    {
//        $this->viewRepository->create([
//            'viewable_type' => get_class($event->thread),
//            'viewable_id' => $event->thread->id,
//            'user_id' => object_get(\Auth::user(), 'id', null),
//            'ip' => \Request::ip()
//        ]);
    }
}
