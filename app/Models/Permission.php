<?php

namespace App\Models;

use App\Lucy\Model;

class Permission extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'permissions';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'display_name', 'description', 'is_removable',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'is_removable' => 'boolean',
    ];

    /**
     * Permissions dropdown.
     * 
     * @return array
     */
    public static function dropdown()
    {
        return static::orderBy('display_name', 'asc')->lists('display_name', 'name');
    }

    /**
     * Get display name based on permission's name.
     * 
     * @param  string  $name
     * @return string
     */
    public static function getDisplayNameByName($name)
    {
        return static::where('name', $name)->first()->display_name;
    }
}
