<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\ProductProperty;
use App\ProductBuyback;
use App\ProductSplitSetDetail;
use App\Product_Sale;


class BuyBackController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        return view('buyback.index');
    }

    private function buyback_query($filter = [])
    {
        DB::statement("SET sql_mode = '' ");

        $productQuery = Product_Sale::query()
            ->select([
                'product_sales.product_id as id',
                DB::raw("COALESCE(product_sales.split_set_code, products.code) as code"),
                'product_sales.split_set_code',
                'split.id as split_id',
                DB::raw("COALESCE(buyback.final_price, products.price) as price"),
                'buyback.final_price as final_price',
                'products.image',
                'products.name',
                'products.discount',
                DB::raw("max(product_sales.created_at) as created_at"),
                'products.tag_type_id',
                'products.gramasi_id',
                'products.mg',
                'tag_types.color as tag_type_color',
                'tag_types.code as tag_type_code',
                'gramasis.gramasi',
                DB::raw("COALESCE(split.invoice_number, products.invoice_number) as invoice_number"),
                // DB::raw("CASE WHEN buyback.id IS NOT NULL THEN 1 ELSE 0 END as buyback_status"),
                DB::raw("CASE 
                WHEN buyback.id IS NOT NULL THEN 
                    CASE 
                        WHEN COALESCE(max(product_sales.created_at), COALESCE(max(split.created_at), max(products.created_at))) > buyback.created_at THEN 0 
                        ELSE 1 
                    END 
                ELSE 0 
            END as buyback_status"),
                DB::raw("COALESCE(split.product_status, products.product_status) as product_status")
            ])
            ->leftJoin('product_buyback as buyback', function ($join) {
                $join->on('product_sales.product_id', '=', 'buyback.product_id');
                $join->where(function ($query) {
                    $query->on('product_sales.split_set_code', '=', 'buyback.code')
                        ->orWhereNull('product_sales.split_set_code'); // Handle case when split_set_code is NULL
                });
            })
            ->leftJoin('products', 'product_sales.product_id', '=', 'products.id')
            ->leftJoin('product_split_set_detail as split', 'product_sales.split_set_code', '=', 'split.split_set_code')
            ->leftJoin('tag_types', 'products.tag_type_id', '=', 'tag_types.id')
            ->leftJoin('gramasis', 'products.gramasi_id', '=', 'gramasis.id')
            ->when($filter['invoiceNumber'] || $filter['code'], function ($query) use ($filter) {
                return $query->where(function ($query) use ($filter) {
                    if ($filter['invoiceNumber']) {
                        $query->orWhereRaw('products.invoice_number LIKE ?', ['%' . $filter['invoiceNumber'] . '%']);
                        $query->orWhereRaw('split.invoice_number LIKE ?', ['%' . $filter['invoiceNumber'] . '%']);
                    }
                    if ($filter['code']) {
                        $query->orWhereRaw('products.code LIKE ?', ['%' . $filter['code'] . '%']);
                        $query->orWhereRaw('split.split_set_code LIKE ?', ['%' . $filter['code'] . '%']);
                    }
                });
            })
            ->orderByDesc('product_sales.created_at')
            ->groupBy('product_sales.product_id', 'product_sales.split_set_code');

        return $productQuery;
    }

    public function buybackDataTable(Request $request)
    {
        $this->authorize('viewAny', Product::class);

        $invoiceNumber = $request->invoice_number;
        $code = $request->code;

        $filter = compact('invoiceNumber', 'code');

        $productQuery = $this->buyback_query($filter);

        $datatable =  DataTables::of($productQuery)
            ->addIndexColumn()
            ->editColumn('created_at', fn ($product) => date('d M Y', strtotime($product->created_at)))
            ->editColumn('price', fn ($product) => $product->price)
            ->addColumn('product_property_description', fn ($product) => $product->product_property_description ?? "-")
            ->addColumn('product_property_code', fn ($product) => $product->product_property_code ?? "-")
            ->addColumn('gramasi_gramasi', fn ($product) => $product->gramasi ?? "-")
            ->addColumn('tag_type_code', fn ($product) => $product->tag_type_code ?? "-")
            ->addColumn('gramasi_code', fn ($product) => $product->gramasi_code ?? "-")
            ->addColumn('product_status', function ($product) {
                return $product->product_status == 1 ? 'STORE' : 'SOLD';
            })
            ->editColumn('buyback_status', function ($product) {
                return $product->buyback_status == 1 ? 'OK' : '-';
            })
            ->addColumn('invoice_number', function ($product) {
                return $product->invoice_number ?? "-";
            })
            ->addColumn('image_preview', function ($q) {
                return '<img src="' . asset($q->image) . '" class="img-thumbnail" width="100" height="100">';
            })
            ->addColumn('tag_type_color', function ($product) {
                $color = $product->tag_type_color ?? "none";
                return '<div class="h-100 w-100" style="background-color: ' . $color . '">' . $color . '</div>';
            })
            ->addColumn('action', function ($product) {
                $user = auth()->user();

                $btnBuyBack = $product->buyback_status == 0 ? '<a class="dropdown-item btn-buyback" href="#" data-productId="' . $product->id . '" data-productCode="' . $product->code . '"><i class="fa fa-arrow-left"></i> Buy Back</a>'
                    : '<a class="dropdown-item btn-disabled bg-default" disabled title="Produk ini telah dibeli sebelumnya!" href="#">-</a>';

                $element =
                    '<div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        ' . $btnBuyBack .
                    '</div>
                </div>';

                return $element;
            })
            ->rawColumns(['tag_type_color', 'action', 'image_preview'])
            ->make();

        return $datatable;
    }

    public function getInvoiceNumber(Request $request)
    {
        $search = $request->search;

        $result = $this->buyback_query(['invoiceNumber' => $search, 'code' => null])
            ->limit(3)
            ->pluck('invoice_number')
            ->map(function ($item) {
                return ['invoice_number' => $item];
            });

        return response()->json($result);
    }


    public function getCode(Request $request)
    {
        $search = $request->search;

        $result = $this->buyback_query(['invoiceNumber' => null, 'code' => $search])
            ->limit(3)
            ->pluck('code')
            ->map(function ($item) {
                return ['code' => $item];
            });

        return response()->json($result);
    }

    public function getDataModalProductBuyBack(Request $request)
    {
        $product_id = $request->id;
        $split_set_code = $request->split_set_code; // split set code

        $product = Product::select([
            'products.id',
            DB::raw("COALESCE(split.split_set_code, products.code) as code"),
            'products.name',
            DB::raw("COALESCE(buyback.final_price, products.price) as price"),
            DB::raw('products.discount * 1000 as discount'),
            'products.description'
        ])
            ->leftJoin('product_split_set_detail as split', 'products.id', '=', 'split.product_id')
            ->leftJoin('product_buyback as buyback', function ($join) {
                $join->on('products.id', '=', 'buyback.product_id');
                $join->where(function ($query) {
                    $query->on('split.split_set_code', '=', 'buyback.code')
                        ->orWhereNull('split.split_set_code'); // Handle case when split_set_code is NULL
                });
            })
            ->when($split_set_code, function ($query) use ($split_set_code) {
                return $query->where('split.split_set_code', $split_set_code);
            })
            ->where('products.id', $product_id)
            ->first();

        return response()->json($product);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $productBuyback = new ProductBuyback();
        $productBuyback->product_id = $request->product_id;
        $productBuyback->code = $request->code;
        $productBuyback->price = $request->price;
        $productBuyback->discount = $request->discount;
        $productBuyback->additional_cost = $request->additional_cost;
        $productBuyback->final_price = $request->final_price;
        $productBuyback->description = $request->description;
        $productBuyback->save();

        DB::commit();

        $response = [
            'status' => true,
            'message' => 'Product has been buyback'
        ];

        return response()->json($response);
    }
}
