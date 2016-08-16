<?php

namespace App\Models;

use App\Lucy\ModelInterface as LucyModelInterface;
use Cartalyst\Sentinel\Roles\EloquentRole as Model;

class Role extends Model implements LucyModelInterface
{
    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'slug', 'permissions', 'is_admin', 'is_removable',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'is_removable' => 'boolean',
    ];

    /**
     * {@inheritDoc}
     */
    public function datatables()
    {
        return static::select('*');
    }

    /**
     * Change name of permissions.
     * 
     * @param  string  $oldName
     * @param  string  $newName
     * @return void
     */
    public static function changePermissionsName($oldName, $newName)
    {
        foreach (static::all() as $data) {
            $role = static::find($data->id);

            $permissions = $role->permissions;
            unset($permissions[$oldName]);
            $newPermissions = $permissions + [$newName => true];

            $role->permissions = $newPermissions;

            $role->save();
        }
    }

    /**
     * Delete permissions.
     * 
     * @param  string  $name
     * @return void
     */
    public static function deletePermissions($name)
    {
        foreach (static::all() as $data) {
            $role = static::find($data->id);

            $permissions = $role->permissions;
            unset($permissions[$name]);

            $role->permissions = $permissions;

            $role->save();
        }
    }

    /**
     * Get all the permissions name by Role ID.
     * 
     * @param  int  $id
     * @return array
     */
    public static function getPermissionsByRoleId($id)
    {
        $permissions = [];

        foreach (static::findOrFail($id)->permissions as $key => $value) {
            $permissions[] = $key;
        }

        return $permissions;
    }

    /**
     * Roles dropdown.
     * 
     * @return array
     */
    public static function dropdown()
    {
        return static::orderBy('name', 'asc')->lists('name', 'id');
    }
}
