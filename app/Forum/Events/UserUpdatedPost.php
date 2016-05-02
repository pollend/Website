<?php


namespace PN\Forum\Events;


use PN\Forum\Post;

class UserUpdatedPost
{
    /**
     * @var Post
     */
    public $post;

    /**
     * UserCreatedPost constructor.
     * @param $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}