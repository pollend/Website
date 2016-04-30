<?php


namespace PN\Users\Http\Requests;


use PN\Http\Requests\Request;

class RegenerateApiKeyRequest extends Request
{
    public function authorize()
    {
        return \Auth::check();
    }

    public function rules()
    {
        return [];
    }
}