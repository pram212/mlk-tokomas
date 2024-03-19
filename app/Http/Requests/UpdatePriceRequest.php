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
            'price' => ['required'],
            'gramasi_id' => ['required'],
            'product_property_id' => ['required']
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
            $isPriceExist = Price::where('price', moneyToNumeric($this->price, ","))
                    ->where('product_property_id',  $this->product_property_id)
                    ->where('gramasi_id', $this->gramasi_id)
                    ->where('id', '!=', $id)
                    ->first();

            if ($isPriceExist) {
                $validator->errors()->add('duplicate_data', 'Failed! price is already exist!');
            }
        });
    }
}
