<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    protected $fillable = ['code', 'description'];

    public function priceProductPropertyDetails()
    {
        return $this->hasMany(PriceProductPropertyDetail::class, 'product_property_id');
    }
}
