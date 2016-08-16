<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleFile extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'module_files';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'module_id', 'path',
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
