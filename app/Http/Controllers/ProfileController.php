<?php

namespace App\Http\Controllers;

use Hash;
use Sentinel;
use JsValidator;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Password rules validation.
     * 
     * @var array
     */
    protected $passwordRules = [
        'old_password' => 'required|min:6',
        'password' => 'required|confirmed|min:6',
        'password_confirmation' => 'required',
    ];

    /**
     * Profile settings page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'user' => user_info()
        ];

        if (! session('tab_active')) {
            session()->flash('tab_active', 'profile');
        }

        return view('user.profile', $data);
    }

    public function settings()
    {
        $data = [
            'user' => user_info(),
            'formProfile' => [
                'method' => 'PUT',
                'url' => action('ProfileController@update', 'profile'),
                'files' => true,
                'id' => 'form-profile',
            ],
            'formPassword' => [
                'method' => 'PUT',
                'url' => action('ProfileController@update', 'password'),
                'id' => 'form-password',
            ],            
            'skins' => config('lucy.skins'),
            'profileValidator' => JsValidator::make($this->getProfileRules()),
            'passwordValidator' => JsValidator::make($this->passwordRules),
        ];

        if (! session('tab_active')) {
            session()->flash('tab_active', 'profile');
        }

        return view('user.settings', $data);
    }
    /**
     * Update user's profile & password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string                    $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type)
    {
        session()->flash('tab_active', $type);

        call_user_func([$this, 'update'.ucfirst($type)], $request);

        return redirect()->action('ProfileController@settings');
    }

    /**
     * Handle update profile.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    private function updateProfile(Request $request)
    {
        $this->validate($request, $this->getProfileRules());

        if ((bool) lucy_config('APP_DEMO')) {
            return back_with_message(trans('lucy.message.demo-mode'), 'warning', false);
        }

        $data = $request->except('_token', '_method', 'avatar');
        $data['full_name'] = $request->input('first_name').' '.$request->input('last_name');
        $user = user_info();

        transaction(function () use ($data, $request, $user) {
            if ($request->hasFile('avatar')) {
                if ($avatar = save_avatar($request->file('avatar'), $user->avatar)) {
                    $data['avatar'] = $avatar;
                }
            }

            Sentinel::update($user, $data);

            lucy_log(trans('lucy.log.update-profile'));
        });
    }

    /**
     * Handle update password.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    private function updatePassword(Request $request)
    {
        $this->validate($request, $this->passwordRules);

        if ((bool) lucy_config('APP_DEMO')) {
            return back_with_message(trans('lucy.message.demo-mode'), 'warning', false);
        }

        if (! Hash::check($request->input('old_password'), user_info('password'))) {
            flash()->error(trans('lucy.message.wrong-old-password'));

            return redirect()->action('ProfileController@index');
        }

        transaction(function () use ($request) {
            Sentinel::update(user_info(), ['password' => $request->input('password')]);

            lucy_log(trans('lucy.log.update-password'));
        });
    }

    /**
     * Get the profile rules for validation.
     * 
     * @return array
     */
    protected function getProfileRules()
    {
        return [
            'avatar' => 'image',
            'email' => 'required|email|unique:users,email,'.user_info('id'),
            'username' => 'required|min:5|unique:users,username,'.user_info('id'),
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }
}
