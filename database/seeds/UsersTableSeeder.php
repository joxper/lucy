<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        array_map('unlink', glob(avatar_path('*')));

        $faker = \Faker\Factory::create();

        $avatar = $faker->image(avatar_path(), 128, 128);
        $avatar = explode(DIRECTORY_SEPARATOR, $avatar);
        $avatar = last($avatar);

        $admin = Sentinel::registerAndActivate([
            'email' => 'jorge@avantpage.com',
            'username' => 'admin',
            'password' => 'testkey',
            'avatar' => $avatar,
            'first_name' => 'Jorge',
            'last_name' => 'Villafuerte',
            'full_name' => 'Super Administrator',
        ]);

        $role = Sentinel::findRoleBySlug('administrator');
        $role->users()->attach($admin);

        for ($i = 1; $i <= 2; $i++) {
            $avatar = $faker->image(avatar_path(), 128, 128);
            $avatar = explode(DIRECTORY_SEPARATOR, $avatar);
            $avatar = last($avatar);

            $user = Sentinel::registerAndActivate([
                'email' => $faker->safeEmail,
                'username' => $faker->userName,
                'password' => 'lucy12345',
                'avatar' => $avatar,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'full_name' => $faker->name,
            ]);

            $role = Sentinel::findRoleBySlug('user');
            $role->users()->attach($user);
        }
    }
}
