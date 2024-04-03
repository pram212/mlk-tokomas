<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceProductPropertyDetail extends Model
{
    protected $table = 'prices_product_property_detail';

    protected $fillable = [
        'price_id',
        'product_property_id',
        'price',
        'created_by',
        'updated_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function price()
    {
        return $this->belongsTo(Price::class, 'price_id');
    }

    public function productProperty()
    {
        return $this->belongsTo(ProductProperty::class, 'product_property_id');
    }
}