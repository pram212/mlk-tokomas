<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gramasi extends Model
{
    protected $fillable = [ 'code', 'product_type_id', 'gramasi','categories_id' ];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
    
}
