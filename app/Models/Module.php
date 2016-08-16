<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'modules';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'description', 'table_name', 'primary_key', 'version', 'create_permission', 'delete_permission', 'edit_permission', 'show_permission', 'user_id', 'icon', 'url',
    ];

    /**
     * Get table's informations for the module.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tables()
    {
        return $this->hasMany(ModuleTable::class);
    }

    /**
     * Get files's for the module.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(ModuleFile::class);
    }

    /**
     * Get the permission that owns the module.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createPermission()
    {
        return $this->belongsTo(Permission::class, 'create_permission');
    }

    /**
     * Get the permission that owns the module.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deletePermission()
    {
        return $this->belongsTo(Permission::class, 'delete_permission');
    }

    /**
     * Get the permission that owns the module.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function editPermission()
    {
        return $this->belongsTo(Permission::class, 'edit_permission');
    }

    /**
     * Get the permission that owns the module.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function showPermission()
    {
        return $this->belongsTo(Permission::class, 'show_permission');
    }

    /**
     * Query Builder for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function datatables()
    {
        return static::with('createPermission', 'deletePermission', 'editPermission', 'showPermission');
    }

    /**
     * Modules menu.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function menus()
    {
        return static::with('showPermission')->orderBy('name')->get();
    }
}
