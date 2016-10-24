<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Device extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'devices';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'category_id', 'client_id', 'user_id', 'admin_id', 'supplier_id', 'label_id', 'purchase_date', 'warranty_months', 'tag', 'serial', 'notes',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo(DeviceCategory::class, 'category_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function label()
    {
        return $this->belongsTo(Label::class, 'label_id');
    }
}
