<?php


namespace PN\Social\Listeners;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Social\Events\CommentCreateUpdateInterface;
use PN\Social\Jobs\NotifyUser;
use PN\Social\Notifications\CommentMentionNotification;

class ScanCommentForMentionsListener extends MentionScanner
{
    use DispatchesJobs;

    public function handle(CommentCreateUpdateInterface $event)
    {
        $users = $this->getUsers($event->getComment()->body);

        foreach ($users as $user) {
            if($user->id != $event->getComment()->getUser()->id) {
                $user->notify(new CommentMentionNotification($event->getComment()->getUser(), $event->getComment()->getAsset()));
            }
        }
    }
}