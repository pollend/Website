<?php

namespace PN\Social\Http\Controllers;


use PN\Http\Controllers\Controller;
use PN\Social\Jobs\CreateComment;

class CommentController extends Controller
{
    public function store()
    {
        $asset = \AssetRepo::find(request('asset_id'));

        $this->dispatch(new CreateComment(\Auth::user(), $asset, request('body')));
    }
}
