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
            $type = PostMentionNotification::class;
            $context = json_encode([
                'post_id' => $event->post->id
            ]);

            $this->dispatch(new NotifyUser($user, $type, $context));
        }
    }
}