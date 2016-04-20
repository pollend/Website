<?php


namespace PN\Social\Http\Requests;


use PN\Http\Requests\Request;

class UpdateCommentRequest extends Request
{
    public function authorize()
    {
        return \Auth::check();
    }

    public function rules()
    {
        return [
            'body' => 'required|min:2'
        ];
    }
}