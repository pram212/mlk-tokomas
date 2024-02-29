<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagType extends Model
{
    protected $fillable = ['code', 'description', 'color'];
}
