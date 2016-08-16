<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Credential extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'credentials';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'client_id', 'asset_id', 'type', 'username', 'password',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
