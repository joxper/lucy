<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'logs';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'user_id', 'ip_address', 'message', 'user_agent',
    ];

    /**
     * {@inheritDoc}
     */
    public $timestamps = false;

    /**
     * Logs activity.
     * 
     * @param  string  $startDate
     * @param  string  $endDate
     * @param  null|int  $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function logs($startDate, $endDate, $user = null)
    {
        $sql = static::join('users', 'users.id', '=', 'logs.user_id')->whereBetween(\DB::raw('DATE(logs.created_at)'), [$startDate, $endDate])->select('logs.ip_address', 'logs.message', 'logs.user_agent', 'users.full_name', 'logs.created_at');

        if ($user && is_int($user)) {
            $sql->where('logs.user_id', $user);
        }

        return $sql->orderBy('logs.created_at', 'desc')->get();
    }

    /**
     * Get user that owns the log.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
