<?php


namespace PN\Social\Jobs;


use Illuminate\Database\Eloquent\Model;
use PN\Jobs\Job;
use PN\Social\Events\UserLikedSome;
use PN\Users\User;

/**
 * Class Like
 * @package PN\Social\Jobs
 */
class Like extends Job
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Model
     */
    private $likeable;

    /**
     * Like constructor.
     * @param User $user
     * @param Model $likeable
     */
    public function __construct(User $user, Model $likeable)
    {
        $this->user = $user;
        $this->likeable = $likeable;
    }

    public function handle()
    {
        $like = new \PN\Social\Like();

        $like->setUser($this->user);
        $like->setLikeable($this->likeable);
        $like->weight = 1;

        \LikeRepo::add($like);

        event(new UserLikedSome($this->user, $this->likeable));
    }
}