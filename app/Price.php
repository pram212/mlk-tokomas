<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $guarded =[];
    protected $fillable = ['price', 'carat', 'gramasi_id', 'product_property_id', 'created_by', 'updated_by'];

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

    public function productProperty() 
    {
        return $this->belongsTo('App\ProductProperty', 'product_property_id');
    }

}
