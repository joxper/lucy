<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class LogsSm extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'logs_sms';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'user_id', 'client_id', 'mobile', 'sms', 'timestamp',
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
