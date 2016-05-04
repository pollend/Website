<?php


namespace PN\Social\Jobs;


use PN\Jobs\Job;
use PN\Social\Notification;

/**
 * Class ReadNotification
 * @package PN\Social\Jobs
 */
class ReadNotification extends Job
{
    /**
     * @var Notification
     */
    private $notification;

    /**
     * ReadNotification constructor.
     * @param Notification $notification
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function handle()
    {
        $this->notification->read = 1;

        \NotificationRepo::edit($this->notification);
    }
}