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
            $productSale->setDiscountPromo();
        });
    }

    public function setDiscountPromo()
    {
        $product = Product::find($this->product_id);
        $product_property_id = $product->product_property_id;
        $current_date_time = date('Y-m-d H:i:s');

        $promo = Promo::select('discount')
            ->where([
                ['product_properties_id', $product_property_id],
                ['start_period', '<=', $current_date_time],
                ['end_period', '>=', $current_date_time]
            ])
            ->latest()
            ->first();
        // ! TODO : set discount promo to product_sales
        // if ($promo)
        $product_sales = Product_Sale::where('product_id', $this->product_id)->get();
        $product_sales->discount_promo = 200;
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
