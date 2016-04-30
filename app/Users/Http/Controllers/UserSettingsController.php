<?php


namespace PN\Users\Http\Controllers;


use PN\Foundation\Http\Controllers\Controller;
use PN\Users\Http\Requests\RegenerateApiKeyRequest;
use PN\Users\Http\Requests\UpdateUserRequest;
use PN\Users\Http\Requests\UserSettingShowRequest;
use PN\Users\Jobs\ChangePassword;
use PN\Users\Jobs\RegenerateApiKey;
use PN\Users\Jobs\SetAvatar;
use PN\Users\Jobs\SetEmailSettings;
use PN\Users\Jobs\SetPaymentMethods;
use PN\Users\Jobs\SetSocialMedia;

class UserSettingsController extends Controller
{
    public function show(UserSettingShowRequest $request)
    {
        $user = \Auth::user();

        return view('users.settings', compact(
            'user'
        ));
    }

    public function regenerateApikey(RegenerateApiKeyRequest $request)
    {
        $user = \Auth::user();

        $this->dispatch(new RegenerateApiKey($user));

        \Notification::success('New api key was generated');

        return back();
    }

    public function update(UpdateUserRequest $request)
    {
        $user = \Auth::user();

        if (\Request::hasFile('avatar')) {
            $this->dispatch(new SetAvatar($user, file_get_contents(\Request::file('avatar')->getRealPath())));
        }

        if(\Request::has('email')) {
            // TODO change email
        }

        $this->dispatch(new SetSocialMedia($user, request('twitter'), request('twitch'), request('steam')));
        $this->dispatch(new SetPaymentMethods($user, request('paypal'), request('bitcoin')));
        $this->dispatch(new SetEmailSettings($user, request('notification_rate'), request('recap_rate')));

        if (\Request::has('password')) {
            if(\Hash::check(request('current_password'), $user->password)) {
                $this->dispatch(new ChangePassword($user, request('password')));

                \Notification::success('Password changed');
            } else {
                \Notification::error('The password you entered is incorrect.');

                return back();
            }
        }

        \Notification::success('Settings saved');

        return back();
    }
}