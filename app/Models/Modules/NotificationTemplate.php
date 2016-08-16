<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class NotificationTemplate extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'notification_templates';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'subject', 'message', 'info', 'sms',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';
}
