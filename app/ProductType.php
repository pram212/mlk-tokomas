<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = ['code', 'description', 'categories_id'];

    public function gramasi()
    {
        return $this->hasMany(Gramasi::class);
    }

    public function categories() 
    {
        return $this->belongsTo('App\Category', 'categories_id');
    }
}
