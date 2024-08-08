<?php

namespace App\Http\Requests;

use App\ProductBuyback as Buyback;
use Illuminate\Foundation\Http\FormRequest;

class StoreBuybackRequest extends FormRequest
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
            'product_id' => ['required', 'integer'],
            'product_code' => ['required', 'string'],
            'description' => ['required', 'string'],
            'is_barang_meleot' => ['required', 'boolean'],
        ];
    }

    // protected function prepareForValidation()
    // {
    // }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
        });
    }
}
