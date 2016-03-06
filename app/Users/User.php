<?php

namespace PN\Users;

class User extends \Illuminate\Foundation\Auth\User
{
    protected $table = 'users';
    public $timestamps = true;
    protected $guarded = array(
        'username',
        'email',
        'password',
        'password_token',
        'remember_token',
        'confirm_token',
        'confirmed',
        'api_key',
        'social',
        'social_name'
    );
    protected $fillable = array(
        'identifier',
        'notification_rate',
        'recap_rate',
        'avatar',
        'title',
        'flair',
        'steam',
        'twitch',
        'twitter',
        'bitcoin',
        'paypal',
        'register_ip',
        'last_activity_ip',
        'last_activity'
    );
    protected $visible = array(
        'identifier',
        'username',
        'confirmed',
        'social',
        'social_name',
        'notification_rate',
        'recap_rate',
        'avatar',
        'title',
        'flair',
        'steam',
        'twitch',
        'twitter',
        'bitcoin',
        'paypal',
        'register_ip',
        'last_activity_ip',
        'last_activity'
    );
    protected $hidden = array('email', 'password', 'password_token', 'remember_token', 'confirm_token', 'api_key');

    public function assets()
    {
        return $this->hasMany(\PN\Assets\Asset::class);
    }

    public function views()
    {
        return $this->hasMany(\PN\Tracking\View::class);
    }

    public function downloads()
    {
        return $this->hasMany(\PN\Tracking\Download::class);
    }

    public function videos()
    {
        return $this->hasMany(\PN\Media\Video::class);
    }

    public function screenshots()
    {
        return $this->hasMany(\PN\Media\Screenshot::class);
    }

    public function likes()
    {
        return $this->hasMany(\PN\Social\Like2::class);
    }

    public function threads()
    {
        return $this->hasMany(\PN\Social\Forum\Thread::class);
    }

    public function threadReads()
    {
        return $this->hasMany(\PN\Social\Forum\Read::class);
    }

    public function attachments()
    {
        return $this->hasMany(\PN\Social\Forum\Attachment::class);
    }

    public function posts()
    {
        return $this->hasMany(\PN\Social\Forum\Post::class);
    }

    public function comments()
    {
        return $this->hasMany(\PN\Social\Comment::class);
    }

    public function notifications()
    {
        return $this->hasMany(\PN\Social\Notification::class);
    }

}
