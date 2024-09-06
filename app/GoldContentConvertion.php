<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoldContentConvertion extends Model
{
    protected $fillable = ['tag_types_id', 'gold_content', 'result'];
    public function tag_type()
    {
        return $this->belongsTo(TagType::class, 'tag_types_id');
    }
}
