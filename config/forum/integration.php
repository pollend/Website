<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Policies
    |--------------------------------------------------------------------------
    |
    | Here we specify the policy classes to use. Change these if you want to
    | extend the provided classes and use your own instead.
    |
    */

    'policies' => [
        'forum' => PN\Forum\Policies\ForumPolicy::class,
        'model' => [
            PN\Forum\Category::class  => PN\Forum\Policies\CategoryPolicy::class,
            PN\Forum\Thread::class    => PN\Forum\Policies\ThreadPolicy::class,
            PN\Forum\Post::class      => PN\Forum\Policies\PostPolicy::class
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Application user model
    |--------------------------------------------------------------------------
    |
    | Your application's user model.
    |
    */

    'user_model' => PN\Users\User::class,

    /*
    |--------------------------------------------------------------------------
    | Application user name
    |--------------------------------------------------------------------------
    |
    | The attribute to use for the username.
    |
    */

    'user_name' => 'username',

];
