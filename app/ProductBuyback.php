<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBuyback extends Model
{
    protected $table = 'product_buyback';

    protected $fillable = [
        'product_id', 'code', 'price', 'discount', 'additional_cost', 'final_price', 'description', 'product_property_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
