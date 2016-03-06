<?php
namespace PN\Users\Http\Controllers;

use PN\Foundation\Http\Controllers\Controller;
use PN\Users\Http\Requests\LoginRequest;
use PN\Users\Http\Requests\RegisterRequest;
use PN\Users\Jobs\RegisterUser;
use PN\Users\Repositories\UserRepositoryInterface;

/**
 * Class AuthController
 * @package ParkitectNexus\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepo;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * @param RegisterRequest $register
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegisterRequest $register)
    {
        $this->dispatch(app(RegisterUser::class, array_values(\Request::only([
            'username',
            'name',
            'email',
            'password'
        ]))));

        return redirect(route('auth.login'));
    }

    /**
     * @param $email
     * @return \Illuminate\Http\RedirectResponse
     * @throws UserDoesNotExist
     */
    public function getResend($email)
    {
        $user = $this->userRepo->findByEmail($email);

        if ($user->confirmed == 0) {
            $this->dispatch(app(SendEmailConfirmEmail::class, [$user->id]));
        }

        Flash::info('Mail resent!');

        return \Redirect::route('auth.login');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function getLogin()
    {
        return \View::make('auth.login');
    }

    /**
     * @param LoginRequest $login
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $login)
    {
        try {
            $valid = $this->userRepo->validateCredentials(\Request::get('email'), \Request::get('password'));

            if ($valid) {
                $user = $this->userRepo->findByEmail(\Request::get('email'));

                \Auth::login($user, \Request::get('remember', false));

                return \Redirect::intended();
            }

            throw new UserDoesNotExist();
        } catch (UserDoesNotExist $e) {
            Flash::error('The entered credentials do not match our records');

            return \Redirect::back();
        } catch (UserNotConfirmed $e) {
            Flash::error('Please check your email to confirm your account, <a href="' . route('auth.resend',
                    [\Input::get('email')]) . '">Resend mail</a>');

            return \Redirect::back();
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getConfirm($token)
    {
        try {
            $user = $this->userRepo->findByConfirmToken($token);

            $user = $this->dispatch(app(ConfirmUser::class, [$user->id]));

            \Auth::login($user, true);

            return \Redirect::intended('/');
        } catch (UserDoesNotExist $e) {
            Flash::error('User does not exist');

            return \Redirect::route('auth.register');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function getForgotPassword()
    {
        return \View::make('auth.request-password');
    }

    /**
     * @param RequestNewPasswordRequest $newPasswordRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postForgotPassword(RequestNewPasswordRequest $newPasswordRequest)
    {
        try {
            $user = $this->userRepo->findByEmail(\Input::get('email'));

            $this->dispatch(app(GenerateNewPasswordToken::class, [$user->id]));

            $this->dispatch(app(SendNewPasswordRequestEmail::class, [$user->id]));
        } catch (UserDoesNotExist $e) {

        }

        Flash::info('A link to reset your password has been sent to ' . \Input::get('email'));

        return \Redirect::back();
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\View\View
     */
    public function getSetNewPassword($token)
    {
        return \View::make('auth.set-password', ['token' => $token]);
    }

    /**
     * @param $token
     * @param SetNewPasswordRequest $newPassword
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSetNewPassword($token, SetNewPasswordRequest $newPassword)
    {
        try {
            $user = $this->userRepo->findByEmail(\Input::get('email'));

            if ($user->password_token == $token) {
                $this->dispatch(app(SetPassword::class, [$user->id, \Input::get('password')]));
            }

            \Auth::login($user, true);

            return \Redirect::intended();
        } catch (UserDoesNotExist $e) {
            Flash::error('The entered credentials do not match our records');

            return \Redirect::back();
        } catch (TokenExpired $e) {
            Flash::error('Password token was already used');

            return \Redirect::back();
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        \Auth::logout();

        return \Redirect::back();
    }
}
