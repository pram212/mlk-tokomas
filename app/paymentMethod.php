<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paymentMethod extends Model
{
    protected $fillable = ['name'];

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetails::class);
    }
}
