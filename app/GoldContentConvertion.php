<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoldContentConvertion extends Model
{
    public function tag_type()
    {
        return $this->belongsTo(TagType::class, 'tag_types_id');
    }
}
