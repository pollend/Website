<?php


namespace PN\Social\Http\Controllers;


use Illuminate\Notifications\DatabaseNotification;
use PN\Foundation\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function redirect($encryptedId)
    {
        $id = \Crypt::decrypt($encryptedId);

        $notification = DatabaseNotification::find($id);

        $notification->markAsRead();

        return redirect($notification->data["url"]);
    }
}