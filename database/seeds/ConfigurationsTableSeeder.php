<?php

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'APP_ENV', 'value' => 'production'],
            ['name' => 'APP_DEBUG', 'value' => false],
            ['name' => 'APP_DEMO', 'value' => false],
            ['name' => 'APP_URL', 'value' => 'http://localhost'],
            ['name' => 'APP_TIMEZONE', 'value' => 'UTC'],
            ['name' => 'APP_NAME', 'value' => 'Lucy'],
            ['name' => 'APP_DESC', 'value' => 'Laravel CRUD Generator with Users Management'],
            ['name' => 'APP_INITIAL', 'value' => 'L'],
            ['name' => 'AUTH_REMEMBER_ME', 'value' => true],
            ['name' => 'AUTH_FORGOT_PASSWORD', 'value' => false],
            ['name' => 'AUTH_TOKEN_LIFETIME', 'value' => 60],
            ['name' => 'AUTH_THROTTLE', 'value' => true],
            ['name' => 'AUTH_THROTTLE_INTERVAL', 'value' => 10],
            ['name' => 'AUTH_THROTTLE_THRESHOLDS', 'value' => 5],
            ['name' => 'REG_ENABLE', 'value' => true],
            ['name' => 'REG_ACTIVATE', 'value' => false],
            ['name' => 'REG_TOKEN_LIFETIME', 'value' => 60],
            ['name' => 'AVATAR_HEIGHT', 'value' => 128],
            ['name' => 'AVATAR_WIDTH', 'value' => 128],
            ['name' => 'MAIL_ENABLE', 'value' => false],
            ['name' => 'MAIL_DRIVER', 'value' => 'smtp'],
            ['name' => 'MAIL_HOST', 'value' => null],
            ['name' => 'MAIL_PORT', 'value' => 2525],
            ['name' => 'MAIL_FROM_ADDRESS', 'value' => null],
            ['name' => 'MAIL_FROM_NAME', 'value' => null],
            ['name' => 'MAIL_ENCRYPTION', 'value' => null],
            ['name' => 'MAIL_USERNAME', 'value' => null],
            ['name' => 'MAIL_PASSWORD', 'value' => null],
            ['name' => 'MAIL_QUEUE', 'value' => false],
            ['name' => 'MAIL_SENDMAIL_PATH', 'value' => '/usr/sbin/sendmail -bs'],
            ['name' => 'SOCIALITE_FACEBOOK_CLIENT_ID', 'value' => null],
            ['name' => 'SOCIALITE_FACEBOOK_CLIENT_SECRET', 'value' => null],
            ['name' => 'SOCIALITE_FACEBOOK_ENABLE', 'value' => false],
            ['name' => 'SOCIALITE_GOOGLE_CLIENT_ID', 'value' => null],
            ['name' => 'SOCIALITE_GOOGLE_CLIENT_SECRET', 'value' => null],
            ['name' => 'SOCIALITE_GOOGLE_ENABLE', 'value' => false],
            ['name' => 'SOCIALITE_TWITTER_CLIENT_ID', 'value' => null],
            ['name' => 'SOCIALITE_TWITTER_CLIENT_SECRET', 'value' => null],
            ['name' => 'SOCIALITE_TWITTER_ENABLE', 'value' => false],
        ];

        foreach ($data as $item) {
            Configuration::create($item);
        }
    }
}
