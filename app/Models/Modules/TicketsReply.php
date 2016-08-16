<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class TicketsReply extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'tickets_replies';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'ticket_id', 'user_id', 'message', 'timestamp',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
