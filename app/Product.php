<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product_Warehouse as ProductWarehouse;

class Product extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public function variant()
    {
        return $this->belongsToMany('App\Variant', 'product_variants')->withPivot('id', 'item_code', 'additional_price');
    }

    public function scopeActiveStandard($query)
    {
        return $query->where([
            ['is_active', true],
            ['type', 'standard']
        ]);
    }

    public function scopeActiveFeatured($query)
    {
        return $query->where([
            ['is_active', true],
            ['featured', 1]
        ]);
    }

    public function tagType()
    {
        return $this->belongsTo(TagType::class);
    }

    public function productProperty()
    {
        return $this->belongsTo(ProductProperty::class);
    }

    public function gramasi()
    {
        return $this->belongsTo(Gramasi::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function productWarehouse()
    {
        return $this->hasMany(ProductWarehouse::class);
    }

    public function productSplitSetDetail()
    {
        return $this->hasMany(ProductSplitSetDetail::class);
    }

    public function productDetailSplitHistory()
    {
        return $this->hasMany(ProductDetailSplitHistory::class);
    }

    public function product_warehouse()
    {
        return $this->hasOne(Product_Warehouse::class);
    }



    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->productWarehouse()->delete();
            $product->productSplitSetDetail()->delete();
        });

        // tambah data product_id dan warehouse_id ke product_warehouse
        static::created(function ($product) {
            // ambil warehouse_id dari akun yang sedang login
            $warehouse_id = auth()->user()->warehouse_id;

            // cek apakah product sudah ada di product_warehouse
            $product_warehouse = ProductWarehouse::where([
                ['product_id', $product->id],
                ['warehouse_id', $warehouse_id]
            ])->first();

            // jika belum ada, tambahkan data product_id dan warehouse_id ke product_warehouse
            if (!$product_warehouse) {
                ProductWarehouse::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $warehouse_id,
                    'qty' => 0,
                ]);
            }
        });
    }
}
