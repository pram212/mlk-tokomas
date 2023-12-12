<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gramasi extends Model
{
    protected $fillable = [ 'code', 'product_type_id', 'gramasi' ];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }
    
}
