<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class LicenseCategory extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'license_categories';

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
