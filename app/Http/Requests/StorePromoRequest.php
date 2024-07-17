<?php

namespace App\Http\Requests;

use App\Promo;
use Illuminate\Foundation\Http\FormRequest;

class StorePromoRequest extends FormRequest
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
            'product_properties_id' => 'required|int|exists:product_properties,id',
            'discount' => 'required|numeric',
            'start_period' => 'required|date|before_or_equal:end_period',
            'end_period' => 'required|date|after_or_equal:start_period',
        ];
    }

    public function messages()
    {
        return [
            'start_date.before_or_equal' => 'The start date must be a date before or equal to the end date.',
            'end_date.after_or_equal' => 'The end date must be a date after or equal to the start date.',
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
        $this->merge([
            'discount' => str_replace('.', '', $this->discount),
            'start_period' => $this->start_period . ' 00:00:00',
            'end_period' => $this->end_period . ' 23:59:59',
        ]);

        $validator->after(function ($validator) {
        });
    }
}
