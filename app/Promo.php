<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_properties_id', 'promo_name', 'discount', 'start_period', 'end_period'
    ];

    public function product_properties()
    {
        return $this->belongsTo('App\ProductProperty', 'product_properties_id');
    }
}
