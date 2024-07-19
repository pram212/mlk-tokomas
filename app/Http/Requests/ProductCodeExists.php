<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use App\Product;
use App\ProductSplitSetDetail;

class ProductCodeExists implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the product code exists in either 'products' or 'product_split_set_detail' table
        $existsInProducts = Product::where('code', $value)->exists();
        $existsInProductSplitSetDetail = ProductSplitSetDetail::where('split_set_code', $value)->exists();

        return $existsInProducts || $existsInProductSplitSetDetail;
    }

    public function message()
    {
        return 'The :attribute must exist in either products or product_split_set_detail table.';
    }
}
