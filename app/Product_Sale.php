<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Sale extends Model
{
    protected $table = 'product_sales';
    protected $fillable = [
        "sale_id", "product_id", "variant_id", "qty", "sale_unit_id", "net_unit_price", "discount", "tax_rate", "tax", "total", "split_set_code"
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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($productSale) {
            $isSplited = $productSale->split_set_code ? true : false;
            $productSale->reduceStockQty($isSplited);
            $productSale->setProductStatus(0, $isSplited);
        });
    }

    public function reduceStockQty($isSplited = false)
    {
        if ($isSplited) {
            $this->decrementProductSplitSetQty();
        } else {
            $this->decrementProductWarehouseQty();
        }
    }

    private function decrementProductSplitSetQty()
    {
        $productSplitSetDetail = ProductSplitSetDetail::where('split_set_code', $this->split_set_code)->first();
        $productSplitSetDetail->decrement('qty_product', $this->qty);
    }

    private function decrementProductWarehouseQty()
    {
        $productWarehouse = ProductWarehouse::where([
            ['product_id', $this->product_id],
            ['warehouse_id', $this->sale->warehouse_id]
        ])->first();
        $productWarehouse->decrement('qty', $this->qty);
    }

    public function setProductStatus($status = 0, $isSplited = false)
    {
        /*
        * 0 = SOLD
        * 1 = STORE
        * 2 = RETURN
        */
        if ($isSplited) {
            $this->updateProductSplitSetStatus($status);
        } else {
            $this->updateProductWarehouseStatus($status);
        }
    }

    private function updateProductSplitSetStatus($status)
    {
        $productSplitSetDetail = ProductSplitSetDetail::where('split_set_code', $this->split_set_code)->first();
        $productSplitSetDetail->update(['product_status' => $status]);
    }

    private function updateProductWarehouseStatus($status)
    {
        $productWarehouse = ProductWarehouse::where([
            ['product_id', $this->product_id],
            ['warehouse_id', $this->sale->warehouse_id]
        ])->first();
        $productWarehouse->update(['product_status' => $status]);
    }
}
