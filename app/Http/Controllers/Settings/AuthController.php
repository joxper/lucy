<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AuthRequest as Request;

class AuthController extends Controller
{
    /**
     * Authentication settings page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'form' => [
                'url' => action(route_action($this, 'update')),
                'method' => 'PUT',
            ],
            'data' => [
                'remember_me' => (bool) lucy_config('AUTH_REMEMBER_ME'),
                'forgot_password' => (bool) lucy_config('AUTH_FORGOT_PASSWORD'),
                'token_lifetime' => (int) lucy_config('AUTH_TOKEN_LIFETIME'),
                'throttle' => (bool) lucy_config('AUTH_THROTTLE'),
                'throttle_interval' => (int) lucy_config('AUTH_THROTTLE_INTERVAL'),
                'throttle_thresholds' => (int) lucy_config('AUTH_THROTTLE_THRESHOLDS'),
            ],
        ];

        return view('settings.auth', $data);
    }

    /**
     * Update authentication settings.
     * 
     * @param  \App\Http\Requests\Settings\AuthRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ((bool) lucy_config('APP_DEMO')) {
            return back_with_message(trans('lucy.message.demo-mode'), 'warning', false);
        }

        $data = $request->except('_token', '_method');
        $data['remember_me'] = (bool) $request->input('remember_me');
        $data['forgot_password'] = (bool) $request->input('forgot_password');
        $data['throttle'] = (bool) $request->input('throttle');

        if ($data['forgot_password']) {
            if (! (bool) lucy_config('MAIL_ENABLE')) {
                flash()->error(trans('lucy.message.set-mail-first', ['feature' => 'Forgot Password']));

                return redirect_action(route_action($this, 'index'));
            }
        }

        transaction(function () use ($data) {
            foreach ($data as $key => $value) {
                $key = 'AUTH_'.strtoupper($key);

                lucy_config($key, $value);
            }

            lucy_log(trans('lucy.log.update-auth-settings'));
        });

        return redirect_action(route_action($this, 'index'));
    }
}
