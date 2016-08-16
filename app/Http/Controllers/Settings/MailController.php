<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\MailRequest as Request;

class MailController extends Controller
{
    /**
     * Mail settings page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'form' => [
                'url' => action(route_action($this, 'update')),
                'method' => 'PUT',
                'id' => 'form-mail',
            ],
            'data' => [
                'dropdown' => config('lucy.mails'),
                'mail_driver' => lucy_config('MAIL_DRIVER'),
                'mail_host' => lucy_config('MAIL_HOST'),
                'mail_port' => lucy_config('MAIL_PORT'),
                'mail_username' => lucy_config('MAIL_USERNAME'),
                'mail_sendmail_path' => lucy_config('MAIL_SENDMAIL_PATH'),
                'mail_encryption' => lucy_config('MAIL_ENCRYPTION'),
                'mail_from_address' => lucy_config('MAIL_FROM_ADDRESS'),
                'mail_from_name' => lucy_config('MAIL_FROM_NAME'),
                'mail_enable' => (bool) lucy_config('MAIL_ENABLE'),
                'mail_queue' => (bool) lucy_config('MAIL_QUEUE'),
            ]
        ];

        return view('settings.mail', $data);
    }

    /**
     * Update mail settings.
     * 
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ((bool) lucy_config('APP_DEMO')) {
            return back_with_message(trans('lucy.message.demo-mode'), 'warning', false);
        }

        $data = $request->except('_token', '_method');
        $enable = (bool) $request->input('mail_enable');
        $queue = (bool) $request->input('mail_queue');

        transaction(function () use ($data, $enable, $queue) {
            if ($enable) {
                foreach ($data as $key => $value) {
                    lucy_config(strtoupper($key), $value);
                }
            } else {
                lucy_config('MAIL_ENABLE', false);
                lucy_config('AUTH_FORGOT_PASSWORD', false);
            }

            lucy_config('MAIL_QUEUE', $queue);

            lucy_log(trans('lucy.log.update-mail-settings'));
        });

        return redirect_action(route_action($this, 'index'));
    }
}
