<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $guarded =[];
    protected $fillable = ['price', 'carat', 'gramasi_id', 'tag_type_id','categories_id','product_type_id', 'created_by', 'updated_by'];

    public function createdBy() 
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() 
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function gramasi() 
    {
        return $this->belongsTo('App\Gramasi', 'gramasi_id');
    }

    public function tagType() 
    {
        return $this->belongsTo('App\TagType', 'tag_type_id');
    }

    public function categories() 
    {
        return $this->belongsTo('App\Category', 'categories_id');
    }

    public function product_type() 
    {
        return $this->belongsTo('App\ProductType', 'product_type_id');
    }

}
