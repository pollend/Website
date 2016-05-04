<?php

namespace PN\Users;


use PN\Foundation\Presenters\Presenter;

class UserPresenter extends Presenter
{
    public function avatarUrl()
    {
        return '/media/avatars/'.$this->model->avatar;
    }

    public function displayName()
    {
        $name = $this->model->username;

        if ($name == '') {
            return $this->model->name;
        }

        return $name;
    }

    public function url()
    {
        return route('users.show', [$this->model->username]);
    }

    public function hasFlair()
    {
        return $this->model->flair != '';
    }

    public function uploadCount()
    {
        $user = $this->model;

        return \Cache::remember('users.uploadcount', rand(10, 30), function() use ($user){
            return $user->assets()->count();
        });
    }

    public function postCount()
    {
        $user = $this->model;

        return \Cache::remember('users.postcount', rand(10, 30), function() use ($user){
            return $user->posts()->count();
        });
    }

    public function likeCount()
    {
        $user = $this->model;

        return \Cache::remember('users.likeCount', rand(10, 30), function() use ($user){
            $count = 0;

            foreach($user->assets as $asset) {
                $count += $asset->likes;
            }

            return $count;
        });
    }

    public function settingsUrl()
    {
        return route('users.settings');
    }

    public function uploadsUrl()
    {
        return route('users.uploads', [$this->model->username]);
    }

    public function downloadsUrl()
    {
        return route('users.downloads', [$this->model->username]);
    }

    public function viewsUrl()
    {
        return route('users.views', [$this->model->username]);
    }

    public function likesUrl()
    {
        return route('users.likes', [$this->model->username]);
    }

    public function registrationDate()
    {
        return date('d F Y', strtotime($this->model->created_at));
    }

    public function twitterUrl()
    {
        return sprintf('https://twitter.com/%s', $this->model->twitter);
    }

    public function twitchUrl()
    {
        return sprintf('https://twitch.tv/%s', $this->model->twitch);
    }

    public function steamUrl()
    {
        return sprintf('https://steamcommunity.com/%s', $this->model->steam);
    }

    public function paypalUrl()
    {
        return sprintf('https://paypal.me/%s', $this->model->paypal);
    }

    public function bitcoinUrl()
    {
        return sprintf('bitcoin:%s', $this->model->bitcoin);
    }
}
