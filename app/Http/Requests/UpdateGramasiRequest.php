<?php

namespace App\Http\Requests;

use App\Gramasi;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGramasiRequest extends FormRequest
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
            $id = $this->route('gramasi'); // get the id from the route
            $isGramasiExist = Gramasi::where('categories_id', $this->categories_id)
                    ->where('product_type_id', $this->product_type_id)
                    ->where('id', '!=', $id)
                    ->first();

            if ($isGramasiExist) {
                $validator->errors()->add('duplicate_data', 'Failed! Gramasi is already exist!');
            }
        });
    }
}
