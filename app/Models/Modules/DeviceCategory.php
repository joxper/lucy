<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class DeviceCategory extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'device_category';

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
