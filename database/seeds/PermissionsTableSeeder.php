<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'users.view', 'display_name' => 'View user(s)', 'description' => null, 'is_removable' => false],
            ['name' => 'users.create', 'display_name' => 'Create a new user', 'description' => null, 'is_removable' => false],
            ['name' => 'users.edit', 'display_name' => 'Edit a user', 'description' => null, 'is_removable' => false],
            ['name' => 'users.delete', 'display_name' => 'Delete a user', 'description' => null, 'is_removable' => false],
            ['name' => 'logs.view', 'display_name' => 'View logs', 'description' => null, 'is_removable' => false],
            ['name' => 'roles.view', 'display_name' => 'View role(s)', 'description' => null, 'is_removable' => false],
            ['name' => 'roles.create', 'display_name' => 'Create a new role', 'description' => null, 'is_removable' => false],
            ['name' => 'roles.edit', 'display_name' => 'Edit a role', 'description' => null, 'is_removable' => false],
            ['name' => 'roles.delete', 'display_name' => 'Delete a role', 'description' => null, 'is_removable' => false],
            ['name' => 'permissions.view', 'display_name' => 'View permission(s)', 'description' => null, 'is_removable' => false],
            ['name' => 'permissions.create', 'display_name' => 'Create a new permission', 'description' => null, 'is_removable' => false],
            ['name' => 'permissions.edit', 'display_name' => 'Edit a permission', 'description' => null, 'is_removable' => false],
            ['name' => 'permissions.delete', 'display_name' => 'Delete a permission', 'description' => null, 'is_removable' => false],
            ['name' => 'settings.general', 'display_name' => 'Set general settings', 'description' => null, 'is_removable' => false],
            ['name' => 'settings.socialite', 'display_name' => 'Set Socialite settings', 'description' => null, 'is_removable' => false],
            ['name' => 'settings.auth', 'display_name' => 'Set authentication settings', 'description' => null, 'is_removable' => false],
            ['name' => 'settings.reg', 'display_name' => 'Set registration settings', 'description' => null, 'is_removable' => false],
            ['name' => 'settings.mail', 'display_name' => 'Set mail settings', 'description' => null, 'is_removable' => false],
            ['name' => 'crud.view', 'display_name' => 'View module(s)', 'description' => null, 'is_removable' => false],
            ['name' => 'crud.create', 'display_name' => 'Create a new module', 'description' => null, 'is_removable' => false],
            ['name' => 'crud.edit', 'display_name' => 'Edit a module', 'description' => null, 'is_removable' => false],
            ['name' => 'crud.delete', 'display_name' => 'Delete a module', 'description' => null, 'is_removable' => false],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
