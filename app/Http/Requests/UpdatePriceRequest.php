<?php

namespace App\Http\Requests;

use App\Price;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceRequest extends FormRequest
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
            // 'price' => ['required'],
            // 'gramasi_id' => ['required'],
            'price_id' => ['required'],
            'tag_type_id' => ['required'],
            'categories_id' => ['required'],
            // 'product_type_id' => ['required'],
        ];
    }

     /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $id = $this->route("price");
            // HIDE GRAMASI DAN PRODUCT TYPE ID
            $isPriceExist = Price::where('tag_type_id', $this->tag_type_id)
                    ->where('categories_id', $this->categories_id)
                    // ->where('product_type_id', $this->product_type_id)
                    ->where('id', '!=', $id)
                    ->first();

            if ($isPriceExist) {
                $validator->errors()->add('duplicate_data', 'Failed! price is already exist!');
            }
        });
    }
}
