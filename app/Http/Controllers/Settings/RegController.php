<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\RegRequest as Request;

class RegController extends Controller
{
    /**
     * Registration settings page.
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
                'enable' => (bool) lucy_config('REG_ENABLE'),
                'activate' => (bool) lucy_config('REG_ACTIVATE'),
                'token_lifetime' => (int) lucy_config('REG_TOKEN_LIFETIME'),
            ],
        ];

        return view('settings.reg', $data);
    }

    /**
     * Update registration settings.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ((bool) lucy_config('APP_DEMO')) {
            return back_with_message(trans('lucy.message.demo-mode'), 'warning', false);
        }

        $data = $request->except('_token', '_method');
        $data['enable'] = (bool) $request->input('enable');
        $data['activate'] = (bool) $request->input('activate');

        if ($data['activate']) {
            if (! (bool) lucy_config('MAIL_ENABLE')) {
                flash()->error(trans('lucy.message.set-mail-first', ['feature' => 'Activation']));

                return redirect_action(route_action($this, 'index'));
            }
        }

        transaction(function () use ($data) {
            foreach ($data as $key => $value) {
                $key = 'REG_'.strtoupper($key);

                lucy_config($key, $value);
            }

            lucy_log(trans('lucy.log.update-reg-settings'));
        });

        return redirect_action(route_action($this, 'index'));
    }
}
