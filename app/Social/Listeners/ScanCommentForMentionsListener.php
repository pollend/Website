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
            $type = CommentMentionNotification::class;
            $context = json_encode([
                'comment_id' => $event->getComment()->id
            ]);

            $this->dispatch(new NotifyUser($user, $type, $context));
        }
    }
}