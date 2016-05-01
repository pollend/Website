<?php


namespace PN\Social\Http\Controllers\Api;


use PN\Foundation\Http\Controllers\Controller;
use PN\Social\Jobs\Like;
use PN\Social\Jobs\Unlike;

class ApiLikeController extends Controller
{
    public function like($type, $id)
    {
        $likeable = \ModelResolver::resolveModel($type);
        $repo = \RepoResolver::resolve($likeable);

        $likeable = $repo->find($id);

        $this->dispatch(new Like(\Auth::user(), $likeable));
    }

    public function unlike($type, $id)
    {
        $likeable = \ModelResolver::resolveModel($type);
        $repo = \RepoResolver::resolve($likeable);

        $likeable = $repo->find($id);

        $this->dispatch(new Unlike(\Auth::user(), $likeable));
    }

    public function likes($type, $id)
    {
        $likeable = \ModelResolver::resolveModel($type);
        $repo = \RepoResolver::resolve($likeable);

        $likeable = $repo->find($id);

        $data = [
            'likes' => $likeable->like_count,
            'liked' => false // default false, may be overridden
        ];

        if(\Auth::check()) {
            $data['liked'] = \Auth::user()->liked($likeable);
        }

        return \Response::json($data);
    }
}