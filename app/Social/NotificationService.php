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
                $notification = app($notificationModel->type, [$notificationModel]);

                $notifications->push($notification);
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