<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        "reference_no", "user_id", "cash_register_id", "customer_id", "warehouse_id", "biller_id", "item", "total_qty", "total_discount", "total_tax", "total_price", "order_tax_rate", "order_tax", "order_discount", "coupon_id", "coupon_discount", "shipping_cost", "grand_total", "sale_status", "payment_status", "paid_amount", "document", "sale_note", "staff_note"
    ];

    public function biller()
    {
        return $this->belongsTo(Biller::class)->withDefault(Biller::defaultAttributes());
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // sale has many product_sale
    public function productSale()
    {
        return $this->hasMany('App\Product_Sale')->with('product');
    }

    public function productSales()
    {
        return $this->hasMany(Product_Sale::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'sale_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($sale) {
            $sale->fillUsedCoupon();
        });
    }

    public function fillUsedCoupon()
    {
        if ($this->coupon_id) {
            $coupon = Coupon::find($this->coupon_id);
            $coupon->used++;
            $coupon->save();
        }
    }
}
