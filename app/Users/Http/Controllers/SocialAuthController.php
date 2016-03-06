<?php

namespace PN\Users\Http\Controllers;


use Illuminate\Support\Str;
use PN\Foundation\Http\Controllers\Controller;
use PN\Users\Exceptions\UserNotFound;
use PN\Users\Http\Requests\SetUsernameRequest;
use PN\Users\Jobs\CreateSocialUser;
use PN\Users\Jobs\SetUsername;
use PN\Users\Repositories\UserRepositoryInterface;

class SocialAuthController extends Controller
{
    private $userRepo;

    /**
     * SocialAuthController constructor.
     * @param $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @param \Request $request
     * @return mixed
     */
    public function getGithub(\Request $request)
    {
        return \Socialite::with('github')->redirect();
    }

    /**
     * @param \Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getGithubCallback(\Request $request)
    {
        return $this->callback('github');
    }

    /**
     * @param \Request $request
     * @return mixed
     */
    public function getFacebook(\Request $request)
    {
        return \Socialite::with('facebook')->redirect();
    }

    /**
     * @param \Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getFacebookCallback(\Request $request)
    {
        return $this->callback('facebook');
    }

    /**
     * @param \Request $request
     * @return mixed
     */
    public function getGoogle(\Request $request)
    {
        return \Socialite::with('google')->redirect();
    }

    /**
     * @param \Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getGoogleCallback(\Request $request)
    {
        return $this->callback('google');
    }

    private function callback($driver)
    {
        if (\Request::has('code')) {
            $userData = \Socialite::with($driver)->user();

            $user = $this->userRepo->findBySocial($userData->id, $driver, $userData->email);

            if($user == null) {
                $user = $this->dispatch(app(CreateSocialUser::class, [
                    $userData->name,
                    $userData->email,
                    $userData->avatar,
                    $userData->id,
                    $driver
                ]));
            } else {
                $user->fill([
                    'social_name' => $driver,
                    'social_id' => $userData->id
                ]);

                $user->save();
            }

            if ($user->username == '') {
                return redirect(route('socialauth.setusername', [\Crypt::encrypt($user->identifier)]));
            }

            \Auth::login($user, true);

            if (\Session::get('client-login', false)) {
                return redirect('api/auth/apikey');
            }
        }

        return redirect(route('home.index'));
    }

    /**
     * @param $encryptedIdentifier
     * @return $this
     * @throws UserNotFound
     */
    public function getSetUsername($encryptedIdentifier)
    {
        $identifier = \Crypt::decrypt($encryptedIdentifier);

        $user = $this->userRepo->findByIdentifier($identifier);

        if($user == null) {
            throw new UserNotFound($identifier);
        }

        if ($user->username != '') {
            abort(418);
            exit;
        }

        $view = 'auth.set-username';

        if (\Session::get('client-login', false)) {
            $view = 'api.auth.set-username';
        }

        return view($view, [
            'encryptedIdentifier' => $encryptedIdentifier,
            'proposedUsername' => Str::slug($user->name)
        ]);
    }

    /**
     * @param $encryptedIdentifier
     * @param SetUsernameRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSetUsername($encryptedIdentifier, SetUsernameRequest $request)
    {
        $identifier = \Crypt::decrypt($encryptedIdentifier);

        $user = $this->userRepo->findByIdentifier($identifier);

        $user = $this->dispatch(app(SetUsername::class, [$user->id, \Request::get('username')]));

        \Auth::login($user, true);

        if (\Session::pull('client-login', false)) {
            return redirect('api/auth/apikey');
        }

        return redirect(route('home.index'));
    }

}
