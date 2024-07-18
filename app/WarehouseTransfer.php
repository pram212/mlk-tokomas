<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseTransfer extends Model
{
    protected $fillable = [
        'transfer_number', 'product_id', 'split_set_code'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function productSplitSetDetail()
    {
        return $this->belongsTo(ProductSplitSetDetail::class, 'split_set_code', 'split_set_code');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($warehouseTransfer) {
            /* change product status to 2 (transfer to warehouse) */
            $warehouseTransfer->setProductStatus(2);

            /* set default value for warehouse_id (1) */
            $warehouseTransfer->warehouse_id = $warehouseTransfer->warehouse_id ?? 1;
            $warehouseTransfer->save();
        });
    }

    public function setProductStatus($status)
    {
        $product_id = $this->product_id;
        $product = Product::where('id', $product_id)->first();

        if ($product) {
            $product->product_status = $status;
            $product->save();
        }
    }
}
