<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['name', 'code'];

    public function creditCards()
    {
        return $this->hasMany(CreditCards::class);
    }
}
