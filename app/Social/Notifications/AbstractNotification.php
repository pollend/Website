<?php


namespace PN\Social\Notifications;


use PN\Social\Notification;

/**
 * Class AbstractNotification
 * @package PN\Social\Notifications
 */
abstract class AbstractNotification
{
    /**
     * @var Notification
     */
    protected $notification;

    /**
     * AbstractNotification constructor.
     * @param Notification $notification
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Returns the human readable text for this notification
     *
     * @return string
     */
    public abstract function getText() : string;

    /**
     * Returns the url to where this notification was triggered
     *
     * @return string
     */
    public abstract function getFinalUrl() : string;

    /**
     * Returns the url that redirects to getFinalUrl
     *
     * @return string
     */
    public function getUrl() : string {
        return route('notifications.redirect', [\Crypt::encrypt($this->notification->id)]);
    }

}