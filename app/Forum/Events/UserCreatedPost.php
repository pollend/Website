<?php

namespace PN\Forum\Events;

use PN\Forum\Post;


/**
 * Class UserCreatedPost
 * @package PN\Forum\Events
 */
class UserCreatedPost
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
