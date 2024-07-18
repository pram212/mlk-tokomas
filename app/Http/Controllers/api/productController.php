<?php

namespace App\Http\Controllers\api;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class productController extends Controller
{
    function productData(Request $request)
    {
        $this->authorize('viewAny', Product::class);

        $productQuery = Product::query()
            ->select([
                'products.id',
                DB::raw("COALESCE(split.split_set_code, products.code) as code"),
                'products.name',
                DB::raw("COALESCE(buyback.final_price, COALESCE(split.price, product_warehouse.price)) as price"),
                DB::raw("COALESCE(split.qty_product, product_warehouse.qty) as qty"),
            ])
            ->leftJoin('product_split_set_detail as split', 'products.id', '=', 'split.product_id')
            ->leftJoin('product_buyback as buyback', function ($join) {
                $join->on('products.id', '=', 'buyback.product_id')
                    ->where(function ($query) {
                        $query->on('split.split_set_code', '=', 'buyback.code')
                            ->orWhereNull('split.split_set_code'); // Handle case when split_set_code is NULL
                    });
            })
            ->leftJoin('product_warehouse', 'products.id', '=', 'product_warehouse.product_id')
            ->with(['category', 'product_warehouse']);

        if (!empty($request->get("category_id")) && $request->get("category_id") != 0) {
            // param sepparated by comma
            $categoryIds = explode(",", $request->get("category_id"));
            $productQuery->whereIn("products.category_id", $categoryIds);
        }

        return DataTables::of($productQuery)
            ->addColumn('category', fn ($product) => $product->category ? $product->category->name : "-")
            ->editColumn('price', fn ($product) => number_format((int)(preg_replace("/\./", "", @$product->price)), 2))
            ->make();
    }

    public function getAll(Request $request)
    {
        $warehouseId = $request->warehouse_id;
        $search = $request->search;
        $product_status = $request->product_status;

        $products = Product::select([
            'products.id',
            'products.name',
            DB::raw('IFNULL(split.split_set_code, products.code) as code')
        ])
            ->leftJoin('product_split_set_detail as split', 'products.id', '=', 'split.product_id')
            ->with(['product_warehouse' => function ($query) {
                $query->select('product_id', 'qty');
            }])
            ->where('is_active', true)
            ->where(DB::raw('IFNULL(split.product_status, products.product_status)'), $product_status ?? 1)
            // ->whereHas('product_warehouse', function ($query) {
            //     $query->where('qty', '>', 0);
            // })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('products.name', 'like', '%' . $search . '%')
                        ->orWhere('products.code', 'like', '%' . $search . '%');
                });
            })
            ->when($warehouseId, function ($query) use ($warehouseId) {
                $query->whereHas('product_warehouse', function ($q) use ($warehouseId) {
                    $q->where('warehouse_id', $warehouseId);
                });
            })
            ->orderBy('products.name', 'asc')
            ->limit(10)
            ->get();

        return response()->json($products);
    }

    function getById($id)
    {
        $product = Product::find($id)->load('product_warehouse.warehouse');
        return response()->json($product);
    }

    public function getByCode(Request $request)
    {
        $code = $request->code;
        $is_split = strpos($code, '-') !== false;

        $product = Product::select([
            'products.id',
            DB::raw("COALESCE(split.split_set_code, products.code) as code"),
            'products.name',
            DB::raw("COALESCE(buyback.final_price, COALESCE(split.price, product_warehouse.price)) as price"),
            DB::raw("COALESCE(split.qty_product, product_warehouse.qty) as qty"),
        ])
            ->leftJoin('product_split_set_detail as split', 'products.id', '=', 'split.product_id')
            ->leftJoin('product_buyback as buyback', function ($join) {
                $join->on('products.id', '=', 'buyback.product_id')
                    ->where(function ($query) {
                        $query->on('split.split_set_code', '=', 'buyback.code')
                            ->orWhereNull('split.split_set_code'); // Handle case when split_set_code is NULL
                    });
            })
            ->leftJoin('product_warehouse', 'products.id', '=', 'product_warehouse.product_id')
            ->with(['category', 'product_warehouse'])
            ->when($is_split, function ($query) use ($code) {
                $query->where('split.split_set_code', $code);
            })
            ->when(!$is_split, function ($query) use ($code) {
                $query->where('products.code', $code);
            })
            ->first();

        return response()->json($product);
    }
}
