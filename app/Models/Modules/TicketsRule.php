<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class TicketsRule extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'tickets_rules';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'ticketid', 'executed', 'name', 'cond_status', 'cond_priority', 'cond_timeelapsed', 'cond_datetime', 'act_status', 'act_priority', 'act_assignto', 'act_notifyadmins', 'act_addreply', 'reply',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function ticketid()
    {
        return $this->belongsTo(Ticket::class, 'ticketid');
    }

    public function actAssignto()
    {
        return $this->belongsTo(User::class, 'act_assignto');
    }
}
