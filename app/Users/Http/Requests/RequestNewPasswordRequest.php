<?php

namespace PN\Users\Http\Requests;


use PN\Http\Requests\Request;

class RequestNewPasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !\Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required'
        ];
    }
}
