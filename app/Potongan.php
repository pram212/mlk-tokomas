<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    //

    protected $table = 'potongan';
    protected $fillable = [
        'code',
        'discount'
    ];
}
