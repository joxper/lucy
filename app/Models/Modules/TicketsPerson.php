<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class TicketsPerson extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'tickets_people';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'user_id', 'ticket_id',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
