<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['name' => 'Administrator', 'slug' => 'administrator', 'is_admin' => true, 'is_removable' => false],
            ['name' => 'User', 'slug' => 'user', 'is_removable' => false],
        ];

        foreach ($datas as $data) {
            Sentinel::getRoleRepository()->createModel()->create($data);
        }
    }
}
