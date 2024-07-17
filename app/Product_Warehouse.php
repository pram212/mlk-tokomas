<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Warehouse extends Model
{
    protected $table = 'product_warehouse';
    protected $fillable = [

        "product_id", "varinat_id", "warehouse_id", "qty", "price"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function scopeFindProductWithVariant($query, $product_id, $variant_id, $warehouse_id)
    {
        return $query->where([
            ['product_id', $product_id],
            ['variant_id', $variant_id],
            ['warehouse_id', $warehouse_id]
        ]);
    }

    public function scopeFindProductWithoutVariant($query, $product_id, $warehouse_id)
    {
        return $query->where([
            ['product_id', $product_id],
            ['warehouse_id', $warehouse_id]
        ]);
    }
}
