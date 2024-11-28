<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseTransfer extends Model
{
    protected $fillable = [
        'transfer_number', 'product_id', 'split_set_code', 'warehouse_id','status_warehouse'
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
        $split_set_code = $this->split_set_code;

        if ($split_set_code != null) {
            $product_split_set = ProductSplitSetDetail::where('split_set_code', $split_set_code)->first();
            $product_split_set->product_status = $status;
            $product_split_set->save();
        } else {
            $product = Product::find($product_id);
            $product->product_status = $status;
            $product->save();
        }
    }
}
