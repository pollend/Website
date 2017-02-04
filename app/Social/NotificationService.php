<?php


namespace PN\Social;


use Illuminate\Support\Collection;

class NotificationService
{
    public function getNotifications()
    {
        $notificationModels = \NotificationRepo::unread(\Auth::user());

        $notifications = new Collection();

        foreach ($notificationModels as $notificationModel) {
            try{
                $type = $notificationModel->type;
                $notification = new $type($notificationModel);

                try {
                    // todo, check somewhere else that this notification can be rendered
                    $notification->getFinalUrl();
                    $notification->getText();

                    $notifications->push($notification);
                } catch (\Exception $e) {
                    // ignore, hotfix
                }

            } catch (\Exception $e) {
                // Don't let the error block because of an bugged notification, just send a log
                \Log::error($e);
            }
        }

        return $notifications;
    }

    public function notificationCount()
    {
        return count(\NotificationRepo::unread(\Auth::user()));
    }
}