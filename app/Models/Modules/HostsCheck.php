<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class HostsCheck extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'hosts_checks';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'host_id', 'name', 'type', 'port', 'monitoring', 'email', 'sms', 'status',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function host()
    {
        return $this->belongsTo(Host::class, 'host_id');
    }
}
