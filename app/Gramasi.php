<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gramasi extends Model
{
    protected $fillable = [ 'product_type_id', 'freetext' ];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

}
