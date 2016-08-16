<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class IcensesAsset extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'icenses_assets';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'license_id', 'asset_id',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function license()
    {
        return $this->belongsTo(License::class, 'license_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
