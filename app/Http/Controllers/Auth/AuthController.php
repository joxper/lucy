<?php

namespace App\Http\Controllers\Auth;

use Reminder;
use Sentinel;
use Socialite;
use Activation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('sentinel_guest', ['except' => 'getLogout']);
    }

    /**
     * Login page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        $form = [
            'url' => action(route_action($this, 'postLogin')),
            'autocomplete' => 'off',
        ];

        return view('auth.login', compact('form'));
    }

    /**
     * Handle login request.
     *
     * @param  \App\Http\Requests\Auth\AuthRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(AuthRequest $request)
    {
        $backToLogin = redirect()->action('Auth\AuthController@getLogin')->withInput();
        $findUser = Sentinel::findByCredentials($request->only('login'));

        // If we can not find user based on email...
        if (! $findUser) {
            flash()->error(trans('lucy.auth.wrong-email-username'));

            return $backToLogin;
        }

        try {
            $remember = (bool) $request->input('remember_me');
            // If password is incorrect...
            if (! $user = Sentinel::authenticate($request->all(), $remember)) {
                flash()->error(trans('lucy.auth.password-incorrect'));

                return $backToLogin;
            }

            // If user is banned...
            if ($user->is_banned) {
                Sentinel::logout($user);
                flash()->error(trans('lucy.auth.user-banned'));

                return $backToLogin;
            }

            lucy_log(trans('lucy.auth.logged-in'));

            return redirect()->intended('/');
        } catch (ThrottlingException $e) {
            flash()->error(trans('lucy.auth.throttling-msg'));
        } catch (NotActivatedException $e) {
            flash()->error(trans('lucy.auth.not-activated-msg'));
        }

        return $backToLogin;
    }

    /**
     * Handle logout request.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        lucy_log(trans('lucy.auth.logged-out'));
        flash()->success(trans('lucy.auth.logged-out'));

        Sentinel::logout();

        return redirect()->action('Auth\AuthController@getLogin');
    }

    /**
     * Redirect user to provider authentication.
     * 
     * @param  string  $provider
     * @return \Illuminate\Http\Response
     */
    public function getSocialiteRedirect($provider)
    {
        if (! (bool) lucy_config('SOCIALITE_'.strtoupper($provider).'_ENABLE')) {
            flash()->error(trans('lucy.auth.login-with-disabled', ['provider' => ucfirst($provider)]));

            return redirect_action(route_action($this, 'getLogin'));
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback after authentication from provider.
     * 
     * @param  string  $provider
     * @return \Illuminate\Http\Response
     */
    public function getSocialiteLogin($provider)
    {
        $user = Socialite::driver($provider)->user();

        $login = $user->email;
        if ('twitter' == $provider) {
            $login = $user->nickname;
        }

        $sentinelUser = Sentinel::findByCredentials(['login' => $login]);
        if (! $sentinelUser) {
            if (! (bool) lucy_config('REG_ENABLE')) {
                flash()->error(trans('lucy.auth.registration-disabled'));

                return redirect_action(route_action($this, 'getLogin'));
            }

            return $this->registerViaSocialite($user);
        }

        if (Activation::completed($sentinelUser)) {
            if ($sentinelUser->is_banned) {
                flash()->error(trans('lucy.auth.user-banned'));

                return redirect_action(route_action($this, 'getLogin'));
            }

            Sentinel::login($sentinelUser);

            return redirect_action('DashboardController@index');
        }

        flash()->error(trans('lucy.auth.please-activate'));

        return redirect_action(route_action($this, 'getLogin'));
    }

    /**
     * Register form.
     * 
     * @param  \Laravel\Socialite\Contracts\User  $user
     * @return \Illuminate\Http\Response
     */
    protected function registerViaSocialite($user)
    {
        $explodeName = explode(' ', $user->name);
        $firstName = $explodeName[0];
        $lastName = implode(' ', array_except($explodeName, 0));

        $avatar = $user->avatar;
        if (isset($user->avatar_original)) {
            $avatar = $user->avatar_original;
        }

        $data = [
            'user' => [
                'email' => $user->email,
                'username' => $user->nickname,
                'password' => null,
                'avatar' =>$avatar,
                'first_name' => $firstName,
                'last_name' => $lastName,
            ],
            'socialite' => true,
        ];

        session(['socialite_data' => $data]);

        return redirect_action(route_action($this, 'getRegister'), ['socialite' => true]);
    }

    /**
     * Register page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getRegister(Request $request)
    {
        if (! (bool) lucy_config('REG_ENABLE')) {
            flash()->error(trans('lucy.auth.registration-disabled'));

            return redirect_action(route_action($this, 'getLogin'));
        }

        $data = [
            'form' => [
                'url' => action(route_action($this, 'postRegister')),
                'autocomplete' => 'off',
                'files' => true,
            ],
            'socialite' => false,
            'user' => [],
        ];

        if (! $request->input('socialite')) {
            session()->forget('socialite_data');
        }

        if (session('socialite_data')) {
            $data = session('socialite_data') + $data;
        }

        return view('auth.register', $data);
    }

    /**
     * Register user.
     * 
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(RegisterRequest $request)
    {
        $data = $request->except('_token', 'socialite', 'password_confirmation');
        $data['full_name'] = $data['first_name'].' '.$data['last_name'];

        if ($request->hasFile('avatar')) {
            if ($avatar = save_avatar($request->file('avatar'))) {
                $data['avatar'] = $avatar;
            }
        }

        $regActivate = (bool) lucy_config('REG_ACTIVATE');
        $registerMethod = ($regActivate) ? 'register' : 'registerAndActivate';

        $user = Sentinel::{$registerMethod}($data);
        $role = Sentinel::findRoleBySlug('user');
        $role->users()->attach($user);

        lucy_log(trans('lucy.log.create-account'), $user->id);

        if ($regActivate) {
            Activation::removeExpired();

            $activation = (Activation::exists($user)) ? Activation::exists($user) : Activation::create($user);

            mail_send('auth.activation', ['code' => $activation->code, 'user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->full_name)->subject('Activate your account!');
            });

            flash()->success(trans('lucy.auth.check-inbox-to-activate'));
        } else {
            flash()->success(trans('lucy.auth.has-been-registered'));
        }

        return redirect_action(route_action($this, 'getLogin'));
    }

    /**
     * Activate user.
     * 
     * @param  \Illuminate\Http\Request   $request
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request)
    {
        $user = Sentinel::findByCredentials(['login' => $request->input('login')]);

        if (! $user) {
            flash()->error(trans('lucy.auth.user-not-registered'));

            return redirect_action(route_action($this, 'getLogin'));
        }

        if (Activation::completed($user)) {
            flash()->success(trans('lucy.auth.already-activated'));

            return redirect_action(route_action($this, 'getLogin'));
        }

        Activation::removeExpired();

        if (Activation::complete($user, $request->input('code'))) {
            flash()->success(trans('lucy.auth.has-been-activated'));
        } else {
            $activation = (Activation::exists($user)) ? Activation::exists($user) : Activation::create($user);

            mail_send('auth.activation', ['code' => $activation->code, 'user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->full_name)->subject('Activate your account!');
            });

            flash()->warning(trans('lucy.auth.activation-code-expired'));
        }

        return redirect_action(route_action($this, 'getLogin'));
    }

    /**
     * Forgot password page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getForgotPassword()
    {
        if (! (bool) lucy_config('AUTH_FORGOT_PASSWORD')) {
            flash()->error(trans('lucy.auth.forgot-pasword-disabled'));

            return redirect_action(route_action($this, 'getLogin'));
        }

        $data = [
            'form' => [
                'url' => action(route_action($this, 'postForgotPassword')),
                'autocomplete' => 'off',
            ],
        ];

        return view('auth.forgot', $data);
    }

    /**
     * Send reset password to user.
     * 
     * @param  \App\Http\Requests\Auth\ForgotPasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postForgotPassword(ForgotPasswordRequest $request)
    {
        $user = Sentinel::findByCredentials(['login' => $request->input('email')]);

        Reminder::removeExpired();

        $reminder = (Reminder::exists($user)) ? Reminder::exists($user) : Reminder::create($user);

        mail_send('auth.reminder', ['code' => $reminder->code, 'user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->full_name)->subject('Forgot Password');
        });

        lucy_log(trans('lucy.log.create-reset'), $user->id);

        flash()->success(trans('lucy.auth.check-inbox-to-reset'));

        return redirect_action(route_action($this, 'getLogin'));
    }

    /**
     * Reset password page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getReset(Request $request)
    {
        Reminder::removeExpired();

        $user = Sentinel::findByCredentials($request->only('login'));

        if (! $user) {
            flash()->error(trans('lucy.auth.user-not-found'));

            return redirect_action(route_action($this, 'getLogin'));
        }

        if (! Reminder::exists($user)) {
            flash()->error(trans('lucy.auth.reset-code-expired'));

            return redirect_action(route_action($this, 'getLogin'));
        }

        $form = [
            'url' => action(route_action($this, 'postReset')),
            'autocomplete' => 'off',
        ];

        return view('auth.reset', compact('form'));
    }

    /**
     * Reset user's password.
     * 
     * @param  \App\Http\Requests\Auth\ResetPasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(ResetPasswordRequest $request)
    {
        $user = Sentinel::findByCredentials($request->only('login'));

        if (Reminder::complete($user, $request->input('code'), $request->input('password'))) {
            flash()->success(trans('lucy.auth.success-reset'));

            lucy_log(trans('lucy.log.reseted'), $user->id);
        } else {
            flash()->error(trans('lucy.auth.cant-reset'));
        }

        return redirect_action(route_action($this, 'getLogin'));
    }
}
