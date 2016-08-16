<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Ticket extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'tickets';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'ticket', 'client_id', 'user_id', 'admin_id', 'asset_id', 'email', 'subject', 'status', 'priority', 'timestamp', 'notes', 'ccs',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
