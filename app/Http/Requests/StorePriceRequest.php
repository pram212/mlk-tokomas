<?php

namespace App\Http\Requests;

use App\Price;
use Illuminate\Foundation\Http\FormRequest;

class StorePriceRequest extends FormRequest
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
            'tag_type_id' => ['required'],
            'categories_id' => ['required'],
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
            $isPriceExist = Price::where('price', moneyToNumeric($this->price, ","))
                    ->where('gramasi_id', $this->gramasi_id)
                    ->where('tag_type_id', $this->tag_type_id)
                    ->where('categories_id', $this->categories_id)
                    ->first();

            if ($isPriceExist) {
                $validator->errors()->add('duplicate_data', 'Failed! price is already exist!');
            }
        });
    }
}
