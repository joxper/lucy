<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class HostsHistory extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'hosts_history';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'check_id', 'status', 'latency', 'timestamp',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function check()
    {
        return $this->belongsTo(HostsCheck::class, 'check_id');
    }
}
