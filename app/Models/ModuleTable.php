<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleTable extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'module_tables';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'column', 'method', 'arguments', 'default', 'unsigned', 'nullable', 'comment', 'is_foreign', 'table_foreign', 'references_foreign', 'relationship_foreign', 'caption', 'show', 'view', 'sortable', 'searchable', 'module_id',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'unsigned' => 'boolean',
        'nullable' => 'boolean',
        'is_foreign' => 'boolean',
        'show' => 'boolean',
        'view' => 'boolean',
        'sortable' => 'boolean',
        'searchable' => 'boolean',
    ];

    /**
     * Get the module that owns the table.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
