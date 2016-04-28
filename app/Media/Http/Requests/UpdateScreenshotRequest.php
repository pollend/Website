<?php


namespace PN\Media\Http\Requests;


use PN\Http\Requests\Request;

class UpdateScreenshotRequest extends Request
{
    public function authorize()
    {
        return \Auth::check();
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3'
        ];
    }
}