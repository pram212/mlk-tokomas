<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    protected $fillable = ['payment_id', 'payment_method_id', 'amount', 'bank_id', 'card_number'];

    public function paymentMethod()
    {
        return $this->belongsTo(paymentMethod::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
