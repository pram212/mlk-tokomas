<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalePosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cashier_id' => ['required'],
            'customer_id' => ['required'],
            'items' => ['required'],
            'paid_amount' => ['required'],
            'paying_amount' => ['required'],
            'payment_methods' => ['required'],
            'warehouse_id' => ['required'],
        ];
    }
}
