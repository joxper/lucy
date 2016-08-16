<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Contact extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'contacts';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';
}
