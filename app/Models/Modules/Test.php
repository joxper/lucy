<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Test extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'test';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'test', 'name',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';
}
