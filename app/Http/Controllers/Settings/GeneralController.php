<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\GeneralRequest as Request;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'dropdownTz' => config('lucy.timezones'),
            'env' => lucy_config('APP_ENV'),
            'debug' => lucy_config('APP_DEBUG'),
            'url' => lucy_config('APP_URL'),
            'timezone' => lucy_config('APP_TIMEZONE'),
            'name' => lucy_config('APP_NAME'),
            'desc' => lucy_config('APP_DESC'),
            'initial' => lucy_config('APP_INITIAL'),
            'form' => [
                'url' => action(route_action($this, 'update')),
                'method' => 'PUT',
            ],
            'dropdownEnv' => config('lucy.env'),
        ];

        return view('settings.general', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Settings\GeneralRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ((bool) lucy_config('APP_DEMO')) {
            return back_with_message(trans('lucy.message.demo-mode'), 'warning', false);
        }

        $data = $request->except('_token', '_method');
        $data['debug'] = (bool) $request->input('debug');

        transaction(function () use ($data) {
            foreach ($data as $key => $value) {
                $key = 'APP_'.strtoupper($key);

                lucy_config($key, $value);
            }

            lucy_log(trans('lucy.log.update-general-settings'));
        });

        return redirect_action(route_action($this, 'index'));
    }
}
