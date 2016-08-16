<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Issue extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'issues';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'client_id', 'asset_id', 'project_id', 'user_id', 'issue_type', 'priority', 'status', 'name', 'description', 'duedate', 'timespent', 'dateadded',
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

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
