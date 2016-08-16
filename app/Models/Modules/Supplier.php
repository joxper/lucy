<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Supplier extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'suppliers';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'address', 'contact_name', 'phone', 'email', 'web', 'notes',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';
}
