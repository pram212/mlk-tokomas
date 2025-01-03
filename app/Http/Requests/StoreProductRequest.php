<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_property_id' => ['required'],
            'additional_code' => ['required'],
            'gold_content' => ['required'],
            'tag_type_id' => ['required'],
            'gramasi_id' => ['required'],
            'discount' => ['required'],
            'price' => ['required'],
            'code' => ['required'],
            'mg' => ['required'],
            'product_type_id' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'split_set_type' => ['required'],
            'warehouse_id' => ['required', 'exists:warehouses,id'],
        ];
    }
}
