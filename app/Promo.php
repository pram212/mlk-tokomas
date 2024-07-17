<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    public function product_properties()
    {
        return $this->belongsTo('App\ProductProperty', 'product_properties_id');
    }
}
