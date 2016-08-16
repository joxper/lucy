<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Manufacturer extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'manufacturers';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';
}
