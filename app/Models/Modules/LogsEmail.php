<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class LogsEmail extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'logs_email';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'user_id', 'client_id', 'to', 'subject', 'message', 'timestamp',
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
