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
        $name = $this->model->name;

        if ($name == '') {
            return $this->model->username;
        }

        return $name;
    }

    public function url()
    {
        return route('users.profile', [$this->model->identifier]);
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

    public function registrationDate()
    {
        return date('F jS Y', strtotime($this->model->created_at));
    }
}
