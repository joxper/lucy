<?php

namespace App\Models\Modules;
use App\Models\Modules\ClientsAdmin as AdminModel;
use App\Lucy\Model;

class Client extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'clients';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'asset_tag_prefix', 'license_tag_prefix',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    /**
     * {@inheritDoc}
     */


    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * Get the assets for the client.
     */
    public function assets()
    {
        return $this->hasMany('App\Models\Modules\Asset');
    }

    public function datatables()
    {
        return static::select('*');
    }
}

