<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class HostsAdmin extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'hosts_admins';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'host_id', 'user_id',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function host()
    {
        return $this->belongsTo(Host::class, 'host_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
