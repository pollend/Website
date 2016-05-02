<?php

namespace PN\Social\Http\Controllers;


use PN\Http\Controllers\Controller;
use PN\Social\Events\UserCommentedOnAsset;
use PN\Social\Http\Requests\CreateCommentRequest;
use PN\Social\Http\Requests\UpdateCommentRequest;
use PN\Social\Jobs\CreateComment;
use PN\Social\Jobs\DeleteComment;
use PN\Social\Jobs\UpdateComment;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request)
    {
        $asset = \AssetRepo::find(request('asset_id'));

        $this->dispatch(new CreateComment(\Auth::user(), $asset, request('body')));

        event(new UserCommentedOnAsset(\Auth::user(), $asset));

        return back();
    }

    public function edit($id)
    {
        $comment = \CommentRepo::find($id);

        return view('comments.edit', compact('comment'));
    }

    public function update($id, UpdateCommentRequest $request)
    {
        $comment = \CommentRepo::find($id);

        $this->dispatch(new UpdateComment($comment, request('body')));

        return redirect($comment->getAsset()->getPresenter()->url);
    }

    public function destroy($id)
    {
        $comment = \CommentRepo::find($id);

        $this->dispatch(new DeleteComment($comment));

        return back();
    }
}
