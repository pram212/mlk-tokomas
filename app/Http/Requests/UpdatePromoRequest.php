<?php

namespace App\Http\Requests;

use App\Promo;
use Illuminate\Foundation\Http\FormRequest;
use carbon\Carbon;

class UpdatePromoRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        // Bersihkan pemisah ribuan dari input discount
        $this->merge([
            'discount' => str_replace('.', '', $this->discount),
            'start_period' => Carbon::parse($this->start_period)->format('Y-m-d') . ' 00:00:00',
            'end_period' => Carbon::parse($this->end_period)->format('Y-m-d') . ' 23:59:59',
        ]);
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
            'promo_name' => 'required|string|max:100',
            'discount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
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
    // public function withValidator($validator)
    // {
    //     $this->merge([
    //         'discount' => str_replace('.', '', $this->discount),
    //         'start_period' => Carbon::parse($this->start_period)->format('Y-m-d') . ' 00:00:00',
    //         'end_period' => Carbon::parse($this->end_period)->format('Y-m-d') . ' 23:59:59',
    //     ]);

    //     $validator->after(function ($validator) {
    //     });
    // }
}
