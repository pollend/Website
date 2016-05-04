<?php


namespace PN\Social\Http\Controllers;


use PN\Foundation\Http\Controllers\Controller;
use PN\Social\Jobs\ReadNotification;

class NotificationController extends Controller
{
    public function redirect($encryptedId)
    {
        $id = \Crypt::decrypt($encryptedId);

        $notification = \NotificationRepo::find($id);
        
        $this->dispatch(new ReadNotification($notification));

        return redirect($notification->getNotification()->getFinalUrl());
    }
}