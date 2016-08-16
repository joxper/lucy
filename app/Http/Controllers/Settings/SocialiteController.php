<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Socialite\GoogleRequest;
use App\Http\Requests\Settings\Socialite\TwitterRequest;
use App\Http\Requests\Settings\Socialite\FacebookRequest;

class SocialiteController extends Controller
{
    /**
     * Socialite settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'formFb' => [
                'url' => action(route_action($this, 'updateFacebook')),
                'id' => 'form-fb',
                'method' => 'PUT',
            ],
            'dataFb' => [
                'facebook_client_id' => lucy_config('SOCIALITE_FACEBOOK_CLIENT_ID'),
                'facebook_client_secret' => lucy_config('SOCIALITE_FACEBOOK_CLIENT_SECRET'),
                'facebook_enable' => (bool) lucy_config('SOCIALITE_FACEBOOK_ENABLE'),
            ],
            'formGoogle' => [
                'url' => action(route_action($this, 'updateGoogle')),
                'id' => 'form-google',
                'method' => 'PUT',
            ],
            'dataGoogle' => [
                'google_client_id' => lucy_config('SOCIALITE_GOOGLE_CLIENT_ID'),
                'google_client_secret' => lucy_config('SOCIALITE_GOOGLE_CLIENT_SECRET'),
                'google_enable' => (bool) lucy_config('SOCIALITE_GOOGLE_ENABLE'),
            ],
            'formTwitter' => [
                'url' => action(route_action($this, 'updateTwitter')),
                'id' => 'form-twitter',
                'method' => 'PUT',
            ],
            'dataTwitter' => [
                'twitter_client_id' => lucy_config('SOCIALITE_TWITTER_CLIENT_ID'),
                'twitter_client_secret' => lucy_config('SOCIALITE_TWITTER_CLIENT_SECRET'),
                'twitter_enable' => (bool) lucy_config('SOCIALITE_TWITTER_ENABLE'),
            ],
        ];

        return view('settings.socialite', $data);
    }

    /**
     * Update facebook socialite settings.
     * 
     * @param  \App\Http\Requests\Settings\Socialite\FacebookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateFacebook(FacebookRequest $request)
    {
        return $this->transaction($request, 'facebook');
    }

    /**
     * Update google socialite settings.
     * 
     * @param  \App\Http\Requests\Settings\Socialite\GoogleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateGoogle(GoogleRequest $request)
    {
        return $this->transaction($request, 'google');
    }

    /**
     * Update twitter socialite settings.
     * 
     * @param  \App\Http\Requests\Settings\Socialite\TwitterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateTwitter(TwitterRequest $request)
    {
        return $this->transaction($request, 'twitter');
    }

    /**
     * Process data to save.
     * 
     * @param  \App\Http\Requests\Request  $request
     * @param  string                      $type
     * @return \Illuminate\Http\Response
     */
    protected function transaction($request, $type)
    {
        if ((bool) lucy_config('APP_DEMO')) {
            return back_with_message(trans('lucy.message.demo-mode'), 'warning', false);
        }

        $data = $request->except('_method', '_token');

        transaction(function () use ($data, $request, $type) {
            if ((bool) $request->input($type.'_enable')) {

                foreach ($data as $key => $value) {
                    $key = 'SOCIALITE_'.strtoupper($key);

                    lucy_config($key, $value);
                }
            } else {
                lucy_config('SOCIALITE_'.strtoupper($type).'_ENABLE', false);
            }

            lucy_log(trans('lucy.log.update-socialite-settings', ['provider' => ucfirst($type)]));
        });

        return redirect_action(route_action($this, 'index'));
    }
}
