<?php

namespace PN\Assets\Http\Requests;


use PN\Http\Requests\Request;

class CreateRequest extends Request
{
    public function authorize()
    {
        return \Auth::check();
    }

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }
}
