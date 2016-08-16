<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Project extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'projects';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'client_id', 'tag', 'name', 'notes', 'description', 'startdate', 'deadline', 'progress',
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
