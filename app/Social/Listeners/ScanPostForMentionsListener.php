<?php


namespace PN\Social\Listeners;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Social\Events\CommentCreateUpdateInterface;
use PN\Social\Jobs\NotifyUser;
use PN\Social\Notifications\PostMentionNotification;

class ScanPostForMentionsListener extends MentionScanner
{
    use DispatchesJobs;

    public function handle($event)
    {
        $users = $this->getUsers($event->post->content);

        foreach ($users as $user) {
            if($user->id != $event->post->user->id) {
                $user->notify(new PostMentionNotification($event->post->user, $event->post));
            }
        }
    }
}