<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Comment extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'comments';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'user_id', 'client_id', 'project_id', 'ticket_id', 'issue_id', 'comment', 'timestamp',
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

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function issue()
    {
        return $this->belongsTo(Issue::class, 'issue_id');
    }
}
