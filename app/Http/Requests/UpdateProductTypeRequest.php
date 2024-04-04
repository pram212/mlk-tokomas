<?php

namespace App\Http\Requests;

use App\ProductType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductTypeRequest extends FormRequest
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
            'description' => 'required',
            'categories_id' => 'required'
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
            $id = $this->route("ProductType");
            $isExist = ProductType::where('code', $this->code)
                    ->where('categories_id', $this->categories_id)
                    ->where('description', $this->description)
                    ->where('id', '!=', $id)
                    ->first();

            if ($isExist) {
                $validator->errors()->add('duplicate_data', 'Failed! ProductType is already exist!');
            }
        });
    }
}
