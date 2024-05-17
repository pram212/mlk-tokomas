<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Sale extends Model
{
	protected $table = 'product_sales';
    protected $fillable =[
        "sale_id", "product_id", "variant_id", "qty", "sale_unit_id", "net_unit_price", "discount", "tax_rate", "tax", "total","split_set_code"
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    // relation with ProductSplitSetDetail by split_set_code
    public function productSplitSetDetail()
    {
        return $this->belongsTo('App\ProductSplitSetDetail', 'split_set_code', 'split_set_code');
    }
}
