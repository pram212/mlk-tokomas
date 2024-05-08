<?php

namespace App\Http\Requests;

use App\TagType;
use Illuminate\Foundation\Http\FormRequest;

class StoreTagTypeRequest extends FormRequest
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
            'code' => 'required|max:50',
            'description' => 'required|max:255',
            'color' => 'required|max:50',
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
            $isTagTypeExist = TagType::where('code', $this->code)->first();

            if ($isTagTypeExist) {
                $validator->errors()->add('duplicate_data', 'Failed! TagType is already exist!');
            }
        });
    }
}
