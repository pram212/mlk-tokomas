<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [

        "purchase_id", "user_id", "sale_id", "cash_register_id", "account_id", "payment_reference", "amount", "change", "paying_method", "payment_note"
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\PaymentMethod');
    }

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetails::class);
    }
}
