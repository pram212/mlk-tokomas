<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBasOnTag extends Model
{
    protected $fillable = ['tag_type_id', 'product_property_id', 'gramasi_id', 'product_type_id', 'mg'];

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
}
