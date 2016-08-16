<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class ClientsAdmin extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'clients_admins';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'user_id', 'client_id',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
