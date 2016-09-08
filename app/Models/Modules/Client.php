<?php

namespace App\Models\Modules;
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

    public static function assetsTables($id)
    {
        return static::find($id)->assets()->with('category', 'supplier', 'label')->get();
    }
}

