<?php


namespace PN\Users\Http\Requests;


use PN\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    public function authorize()
    {
        return \Auth::check();
    }

    public function rules()
    {
        return [
            'avatar' => 'max:5000|mimes:jpeg,png',
            'email' => 'email|unique:users',
            'current_password' => 'required_with:password',
            'password' => 'confirmed|min:6',
            'notification_rate' => 'required',
            'recap_rate' => 'required'
        ];
    }
}