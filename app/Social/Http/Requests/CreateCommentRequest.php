<?php


namespace PN\Social\Http\Requests;


use PN\Http\Requests\Request;

class CreateCommentRequest extends Request
{
    public function authorize()
    {
        return \Auth::check();
    }

    public function rules()
    {
        return [
            'asset_id' => 'required',
            'body' => 'required|min:2'
        ];
    }
}