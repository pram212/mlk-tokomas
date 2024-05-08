<?php

namespace App\Http\Requests;

use App\TagType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTagTypeRequest extends FormRequest
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
            $id = $this->route('tagtype'); // get the id from the route
            $isTagTypeExist = TagType::where('code', $this->code)
                    ->where('id', '!=', $id)
                    ->first();

            if ($isTagTypeExist) {
                $validator->errors()->add('duplicate_data', 'Failed! TagType is already exist!');
            }
        });
    }
}
