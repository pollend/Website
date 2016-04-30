<?php

namespace PN\Users\Http\Controllers;


use PN\Assets\Asset;
use PN\Foundation\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    public function show($username)
    {
        return $this->uploads($username);
    }

    public function uploads($username)
    {
        $tab = 'uploads';
        
        $user = \UserRepo::findByUsername($username);

        $assets = \AssetRepo::forUser($user, true);

        return view('users.uploads', compact(
            'user',
            'tab',
            'assets'
        ));
    }

    public function downloads($username)
    {
        $tab = 'downloads';

        $user = \UserRepo::findByUsername($username);

        $downloads = \DownloadRepo::recentForUser($user, Asset::class, true);

        return view('users.downloads', compact(
            'user',
            'tab',
            'downloads'
        ));
    }

    public function views($username)
    {
        $tab = 'views';

        $user = \UserRepo::findByUsername($username);

        $views = \ViewRepo::recentForUser($user, Asset::class, true);

        return view('users.views', compact(
            'user',
            'tab',
            'views'
        ));
    }

    public function likes($username)
    {
        $tab = 'likes';

        $user = \UserRepo::findByUsername($username);

        $likes = \LikeRepo::recentForUser($user, Asset::class, true);

        return view('users.likes', compact(
            'user',
            'tab',
            'likes'
        ));
    }
}
