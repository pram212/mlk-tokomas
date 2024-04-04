<?php

namespace App\Http\Requests;

use App\Gramasi;
use Illuminate\Foundation\Http\FormRequest;

class StoreGramasiRequest extends FormRequest
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
            'code' => 'required',
            'categories_id' => 'required',
            'product_type_id' => 'required',
            'gramasi' => 'required'
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
            $isGramasiExist = Gramasi::
                    where('code', $this->code)
                    ->first();

            if ($isGramasiExist) {
                $validator->errors()->add('duplicate_data', 'Failed! Gramasi is already exist!');
            }
        });
    }
}
