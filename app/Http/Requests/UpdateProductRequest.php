<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'tag_type_id' => ['required'],
            'gramasi_id' => ['required'],
            'discount' => ['required'],
            'price' => ['required'],
            'mg' => ['required'],
            'code' => ['required'],
            'product_property_id' => ['required'],
        ];
    }
}
