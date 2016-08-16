<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class AssetCategory extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'asset_categories';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'color',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';
}
