<?php

namespace App\Providers;

use Schema;
use App\Models\Configuration;
use Illuminate\Support\ServiceProvider;

class LucyConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->alreadyInstalled()) {
            if (Schema::hasTable('configurations') && Configuration::count()) {
                $this->bootRegConfig();
                $this->bootAuthConfig();
                $this->bootMailConfig();
                $this->bootGeneralConfig();
                $this->bootSocialiteConfig();
                $this->bootSentinelCheckpoints();
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot general configurations.
     * 
     * @return void
     */
    private function bootGeneralConfig()
    {
        date_default_timezone_set(lucy_config('APP_TIMEZONE'));

        config([
            'app.timezone' => lucy_config('APP_TIMEZONE'),
            'app.env' => lucy_config('APP_ENV'),
            'app.debug' => (bool) lucy_config('APP_DEBUG'),
            'app.url' => lucy_config('APP_URL'),
            'app.timezone' => lucy_config('APP_TIMEZONE'),
        ]);
    }

    /**
     * Boot socialite configurations.
     * 
     * @return void
     */
    private function bootSocialiteConfig()
    {
        config([
            // Facebook socialite...
            'services.facebook.client_id' => lucy_config('SOCIALITE_FACEBOOK_CLIENT_ID'),
            'services.facebook.client_secret' => lucy_config('SOCIALITE_FACEBOOK_CLIENT_SECRET'),
            'services.facebook.redirect' => action('Auth\AuthController@getSocialiteLogin', 'facebook'),

            // Google socialite...
            'services.google.client_id' => lucy_config('SOCIALITE_GOOGLE_CLIENT_ID'),
            'services.google.client_secret' => lucy_config('SOCIALITE_GOOGLE_CLIENT_SECRET'),
            'services.google.redirect' => action('Auth\AuthController@getSocialiteLogin', 'google'),

            // Twitter socialite...
            'services.twitter.client_id' => lucy_config('SOCIALITE_TWITTER_CLIENT_ID'),
            'services.twitter.client_secret' => lucy_config('SOCIALITE_TWITTER_CLIENT_SECRET'),
            'services.twitter.redirect' => action('Auth\AuthController@getSocialiteLogin', 'twitter'),
        ]);
    }

    /**
     * Boot mail configurations.
     * 
     * @return void
     */
    private function bootMailConfig()
    {
        config([
            'mail.driver' => lucy_config('MAIL_DRIVER'),
            'mail.host' => lucy_config('MAIL_HOST'),
            'mail.port' => lucy_config('MAIL_PORT'),
            'mail.from.address' => lucy_config('MAIL_FROM_ADDRESS'),
            'mail.from.name' => lucy_config('MAIL_FROM_NAME'),
            'mail.encryption' => lucy_config('MAIL_ENCRYPTION'),
            'mail.username' => lucy_config('MAIL_USERNAME'),
            'mail.password' => lucy_config('MAIL_PASSWORD'),
            'mail.sendmail' => lucy_config('MAIL_SENDMAIL_PATH'),
        ]);
    }

    /**
     * Boot authentication settings.
     * 
     * @return void
     */
    private function bootAuthConfig()
    {
        $throttleInterval = (int) lucy_config('AUTH_THROTTLE_INTERVAL') * 60;
        $thresholds = (int) lucy_config('AUTH_THROTTLE_THRESHOLDS');

        config([
            'cartalyst.sentinel.reminders.expires' => ((int) lucy_config('AUTH_TOKEN_LIFETIME') * 60),
            'cartalyst.sentinel.throttling.global.interval' => 0,
            'cartalyst.sentinel.throttling.global.thresholds' => 0,
            'cartalyst.sentinel.throttling.ip.interval' => 0,
            'cartalyst.sentinel.throttling.ip.thresholds' => 0,
            'cartalyst.sentinel.throttling.user.interval' => $throttleInterval,
            'cartalyst.sentinel.throttling.user.thresholds' => $thresholds,
        ]);
    }

    /**
     * Boot sentinel's checkpoints configurations.
     * 
     * @return void
     */
    private function bootSentinelCheckpoints()
    {
        $checkpoints = [];

        if ((bool) lucy_config('AUTH_THROTTLE')) {
            $checkpoints[] = 'throttle';
        }

        if ((bool) lucy_config('REG_ACTIVATE')) {
            $checkpoints[] = 'activation';
        }

        config(['cartalyst.sentinel.checkpoints' => $checkpoints]);
    }

    /**
     * Boot registration configurations.
     * 
     * @return void
     */
    private function bootRegConfig()
    {
        config([
            'cartalyst.sentinel.activations.expires' => ((int) lucy_config('REG_TOKEN_LIFETIME') * 60),
        ]);
    }

    /**
     * Check if the app is already installed.
     *
     * @return bool
     */
    private function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }
}
