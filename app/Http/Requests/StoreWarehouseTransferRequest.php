<?php

namespace App\Http\Requests;

use App\Product;
use App\WarehouseTransfer;
use App\Http\Requests\ProductCodeExists;
use App\ProductSplitSetDetail;
use Illuminate\Foundation\Http\FormRequest;

class StoreWarehouseTransferRequest extends FormRequest
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
            'product_code' => 'required|array',
            'product_code.*' => ['required', 'string', new ProductCodeExists],
        ];
    }

    public function messages()
    {
        return [
            'product_code.required' => 'Product code is required',
            'product_code.*.required' => 'Product code is required',
            'product_code.*.string' => 'Product code must be a string',
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
            $productCodes = $this->input('product_code');
            $data = collect($productCodes)->map(function ($productCode) use ($validator) {
                $product = Product::where('code', $productCode)->first();

                if ($product) {
                    return [
                        'transfer_number' => $this->gen_transfer_number(),
                        'product_id' => $product->id,
                        'split_set_code' => null,
                        'warehouse_id' => 1,
                    ];
                }

                $productSplitSet = ProductSplitSetDetail::where('split_set_code', $productCode)->first();

                if ($productSplitSet) {
                    return [
                        'transfer_number' => $this->gen_transfer_number(),
                        'product_id' => $productSplitSet->product_id,
                        'split_set_code' => $productCode,
                        'warehouse_id' => 1,
                    ];
                }

                $validator->errors()->add('product_code', 'Product code not found');
                return null; // Invalid entry, will be filtered out
            })->filter()->all();

            $this->merge(['data' => $data]);

            $this->request->remove('product_code'); // remove product_code from request
        });
    }

    private function gen_transfer_number()
    {
        $tf_number = 'TF' . date('Ymd') . rand(1000, 9999);
        $tf_number_exists = WarehouseTransfer::where('transfer_number', $tf_number)->exists();

        if ($tf_number_exists) {
            return $this->gen_transfer_number();
        }

        return $tf_number;
    }
}
