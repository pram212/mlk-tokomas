<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = ['code', 'description'];

    public function gramasi()
    {
        return $this->hasMany(Gramasi::class);
    }
}