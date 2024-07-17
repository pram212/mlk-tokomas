<?php

namespace App\Http\Requests;

use App\Promo;
use Illuminate\Foundation\Http\FormRequest;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'discount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
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
            // $id = $this->route('promo'); // get the id from the route
            // $isExist = Promo::where('code', $this->code)
            //     ->where('id', '!=', $id)
            //     ->first();

            // if ($isExist) {
            //     $validator->errors()->add('duplicate_data', 'Failed! Promo is already exist!');
            // }
        });
    }
}
