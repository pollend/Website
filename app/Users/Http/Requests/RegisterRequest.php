<?php

namespace PN\Users\Http\Requests;


use PN\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        // you can't be logged in for registering
        return !\Auth::check();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users,username|alpha_dash',
            'name' => 'required',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ];
    }
}
