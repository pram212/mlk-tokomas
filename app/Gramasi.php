<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gramasi extends Model
{
    protected $fillable = [ 'code', 'product_type_id', 'gramasi','categories_id' ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($gramasi) {
            if ($gramasi->prices()->exists()) {
                throw new \Exception(trans('file.Failed to be deleted because it was used by prices'));
            }
        });
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'gramasi_id');
    }

   
    
}
