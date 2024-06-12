<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{
    protected $fillable =[
        "name", "image", "company_name", "vat_number",
        "email", "phone_number", "address", "city",
        "state", "postal_code", "country", "is_active"
    ];

    public function sale()
    {
    	return $this->hasMany('App\Sale');
    }

    // Metode untuk mendapatkan atribut default
    public static function defaultAttributes()
    {
        $instance = new static;
        $attributes = [];

        foreach ($instance->getFillable() as $attribute) {
            $attributes[$attribute] = '-';
        }

        return $attributes;
    }
}
