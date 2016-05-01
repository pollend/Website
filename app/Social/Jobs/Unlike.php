<?php


namespace PN\Social\Jobs;


use Illuminate\Database\Eloquent\Model;
use PN\Jobs\Job;
use PN\Social\Events\UserUnlikedSome;
use PN\Users\User;

/**
 * Class Unlike
 * @package PN\Social\Jobs
 */
class Unlike extends Job
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
     * Unlike constructor.
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
        $like = \LikeRepo::findByUserAndLikeable($this->user, $this->likeable);

        \LikeRepo::remove($like);

        event(new UserUnlikedSome($this->user, $this->likeable));
    }
}