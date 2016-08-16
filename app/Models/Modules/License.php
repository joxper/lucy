<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class License extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'licenses';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'client_id', 'status_id', 'category_id', 'supplier_id', 'tag', 'name', 'serial', 'notes',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function status()
    {
        return $this->belongsTo(Label::class, 'status_id');
    }

    public function category()
    {
        return $this->belongsTo(LicenseCategory::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
