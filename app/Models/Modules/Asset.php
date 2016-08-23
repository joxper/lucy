<?php

namespace App\Models\Modules;

use App\Lucy\Model;

class Asset extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'assets';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'category_id', 'admin_id', 'client_id', 'user_id', 'item_id', 'supplier_id', 'status_id', 'purchase_date', 'warranty_months', 'tag', 'name', 'serial', 'notes',
    ];

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'category_id');
    }

    public function admin()
    {
        return $this->belongsTo(Client::class, 'admin_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function status()
    {
        return $this->belongsTo(Label::class, 'status_id');
    }
}
