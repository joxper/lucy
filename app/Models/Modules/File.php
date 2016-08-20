<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class File extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'files';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'client_id', 'project_id', 'asset_id', 'ticketreply_id', 'name', 'file',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function ticketreply()
    {
        return $this->belongsTo(TicketsReply::class, 'ticketreply_id');
    }
}
