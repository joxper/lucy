<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Host extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'hosts';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'client_id', 'name', 'address', 'status',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
