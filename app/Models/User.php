<?php

namespace App\Models;

use App\Lucy\ModelInterface as LucyModelInterface;
use Cartalyst\Sentinel\Users\EloquentUser as Model;

class User extends Model implements LucyModelInterface
{
    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'email', 'username', 'password', 'avatar', 'skin', 'permissions', 'first_name', 'last_name', 'full_name', 'is_banned', 'client_id',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'is_banned' => 'boolean',
    ];

    /**
     * {@inheritDoc}
     */
    protected $loginNames = [
        'email', 'username',
    ];

    /**
     * {@inheritDoc}
     */
    public function datatables()
    {
        return static::select('id', 'email', 'username', 'full_name');
    }

    /**
     * Users dropdown.
     * 
     * @return array
     */
    public static function dropdown()
    {
        return static::orderBy('full_name', 'asc')->lists('full_name', 'id');
    }

    /**
     * Get all logs for the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    /**
     * Get data for chart.
     *
     * @param  null|string  $year
     * @return string
     */
    public function chart($year = null)
    {
        if (is_null($year)) {
            $year = date('Y');
        }

        $data = [];

        foreach (cal_info(0)['months'] as $key => $value) {
            switch (env('DB_CONNECTION')) {
                case 'mysql':
                    $total = static::selectRaw("COUNT(id) AS total")->whereRaw("YEAR(created_at) = {$year}")->whereRaw("MONTH(created_at) = {$key}")->first()->total;
                    break;
                case 'pgsql':
                    $total = static::selectRaw("COUNT(id) AS total")->whereRaw("extract(year from created_at) = '{$year}'")->whereRaw("extract(month from created_at) = {$key}")->first()->total;
                    break;
            }

            $data[] = [
                'y' => $year.'-'.str_pad($key, 2, '0', STR_PAD_LEFT),
                'a' => $total,
            ];
        }

        return json_encode($data);
    }
}
