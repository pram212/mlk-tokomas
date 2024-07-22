<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    protected $table = 'invoice_settings';

    protected $fillable = [
        'warehouse_id',
        'invoice_prefix',
        'invoice_logo',
        'invoice_logo_text',
        'invoice_logo_watermark',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::updating(function ($invoiceSetting) {
    //         if ($invoiceSetting->isDirty('invoice_logo')) {
    //             $invoiceSetting->deleteInvoiceLogo();
    //         }
    //     });
    // }
}
