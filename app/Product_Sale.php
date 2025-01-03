<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Sale extends Model
{
    protected $table = 'product_sales';
    protected $fillable = [
        "sale_id", "product_id", "variant_id", "qty", "sale_unit_id", "net_unit_price", "discount", "tax_rate", "tax", "total", "split_set_code", "discount_promo"
    ];

    // relation with Sale by sale_id
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

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
            // $productSale->reduceStockQty($isSplited);
            $productSale->setProductStatus(0, $isSplited);
            $productSale->setDiscountPromo();
        });
    }

    public function setDiscountPromo()
    {
        $discount_promo = null;
        $promo_name = null;
        $product_id = $this->product_id;

        // Find the product by code
        $product = Product::where('id', $product_id)->first();

        // Check if product exists
        if ($product) {
            $product_property_id = $product->product_property_id;
            // Find the latest promo within the valid date range
            $promo = Promo::where('product_properties_id', $product_property_id)
                ->whereDate('start_period', '<=', now())
                ->whereDate('end_period', '>=', now())
                ->latest()
                ->first();

            // Check if promo exists
            if ($promo) {
                $discount_promo = $promo->discount;
                $promo_name = $promo->promo_name;
            };
        }

        $this->discount_promo = $discount_promo;
        $this->promo_name = $promo_name;
        $this->save();
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
        $sale = Sale::find($this->sale_id);
        $productWarehouse = Product_Warehouse::where([
            ['product_id', $this->product_id],
            ['warehouse_id', $sale->warehouse_id]
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
            $this->updateProductStatus($status);
        }
    }

    private function updateProductSplitSetStatus($status)
    {
        $productSplitSetDetail = ProductSplitSetDetail::where('split_set_code', $this->split_set_code)->first();
        $productSplitSetDetail->update(['product_status' => $status]);
    }

    private function updateProductStatus($status)
    {
        $product = Product::find($this->product_id);
        $product->update(['product_status' => $status]);
    }
}
