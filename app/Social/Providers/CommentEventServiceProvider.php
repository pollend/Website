<?php


namespace PN\Social\Providers;


use Illuminate\Contracts\Events\Dispatcher;
use PN\Providers\EventServiceProvider;
use PN\Social\Events\CommentWasCreated;
use PN\Social\Events\CommentWasUpdated;
use PN\Social\Events\UserCommentedOnAsset;
use PN\Social\Listeners\NotifyUserOfCommentListener;
use PN\Social\Listeners\ScanCommentForMentionsListener;

class CommentEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        CommentWasCreated::class => [
            ScanCommentForMentionsListener::class
        ],
        CommentWasUpdated::class => [
            ScanCommentForMentionsListener::class
        ],
        UserCommentedOnAsset::class => [
            NotifyUserOfCommentListener::class
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  Dispatcher $events
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        parent::boot($events);

        //
    }
}