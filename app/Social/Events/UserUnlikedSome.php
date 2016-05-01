<?php


namespace PN\Social\Events;


use Illuminate\Database\Eloquent\Model;
use PN\Users\User;

class UserUnlikedSome
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var Model
     */
    public $likeable;

    /**
     * UserLikedSome constructor.
     * @param User $user
     * @param Model $likeable
     */
    public function __construct(User $user, Model $likeable)
    {
        $this->user = $user;
        $this->likeable = $likeable;
    }
}