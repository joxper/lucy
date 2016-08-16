<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Label extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'labels';

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
