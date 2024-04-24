<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetailSplitHistory extends Model
{
    protected $table = 'product_detail_split_history';

    protected $fillable = [
        'product_id', 'split_set_code', 'qty_product'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
