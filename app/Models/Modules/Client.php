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


    public function admins()
    {
        return $this->hasMany('App\Models\Modules\ClientsAdmin');
    }        
}

