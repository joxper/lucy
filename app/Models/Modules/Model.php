<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Model extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'models';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'manufacturer_id', 'name',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }
}
