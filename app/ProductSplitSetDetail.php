<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSplitSetDetail extends Model
{
    protected $table = 'product_split_set_detail';

    protected $fillable = [
        'product_id', 'split_set_code', 'qty_product', 'product_status', 'invoice_number', 'price', 'gramasi', 'mg'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouseTransfer()
    {
        return $this->hasMany(WarehouseTransfer::class, 'split_set_code', 'split_set_code');
    }
}
