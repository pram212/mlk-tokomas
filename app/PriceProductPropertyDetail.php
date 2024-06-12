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

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($productProperty) {
            if ($productProperty->productProperty()->exists()) {
                throw new \Exception(trans('file.Failed to be deleted because it was used by product Properties'));
            }
        });
    }

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
