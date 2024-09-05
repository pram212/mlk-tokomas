<?php

namespace App\Http\Requests;

use App\Sale;
use App\Product;
use App\Product_Sale;
use App\ProductBuyback as Buyback;
use Illuminate\Foundation\Http\FormRequest;

class StoreBuybackRequest extends FormRequest
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
            'product_id' => ['required', 'integer'],
            'product_code' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'is_barang_meleot' => ['required', 'boolean'],
        ];
    }

    // protected function prepareForValidation()
    // {
    // }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $product_id = $this->input('product_id');
            $product_code = $this->input('product_code');
            $description = $this->input('description');
            $is_barang_meleot = $this->input('is_barang_meleot');

            $data_buyback = $this->prepare_data_buyback([
                'product_id' => $product_id,
                'product_code' => $product_code,
                'description' => $description,
                'is_barang_meleot' => $is_barang_meleot,
            ]);
            $this->merge($data_buyback);
            $this->merge(['code' => $product_code]);
        });
    }

    private function prepare_data_buyback($data)
    {
        $product_sale = Product_sale::when(
            $this->is_split_product($data['product_code']),
            function ($query) use ($data) {
                $query->where('product_id', $data['product_id'])
                    ->where('split_set_code', $data['product_code']);
            },
            function ($query) use ($data) {
                $query->where('product_id', $data['product_id']);
            }
        )
            ->latest()->first();

        $invoice_number = Sale::where('id', $product_sale->sale_id)->first()->reference_no;

        $product = Product::find($data['product_id']);

        $price_total = @$product_sale->total ?? 0; // Latest total from product_sale
        $additional_cost = @$product->additional_cost ?? 0; // additional cost set by Management (Table Products)

        /* handle if product is 'barang meleot' then discount is 2x */
        $discount = ($data['is_barang_meleot']) ? 2 * @$product_sale->discount : @$product_sale->discount; // discount from product_sale

        /* total discount after calculate discount (Product Sales) */
        /* + additional cost (set by Management in Table Products) */
        $total_discount = @$discount + $additional_cost ?? 0;

        $final_price = $price_total - $total_discount; // price - (discount + additional cost)

        // insert to request data
        $data['price'] = $price_total;
        $data['additional_cost'] = $additional_cost;
        $data['discount'] = $discount;
        $data['final_price'] = $final_price;
        $data['invoice_number'] = $invoice_number;

        return $data;
    }

    private function is_split_product($product_code)
    {
        return strpos($product_code, '-') !== false;
    }
}
