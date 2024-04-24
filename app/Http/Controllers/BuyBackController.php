<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;


class BuyBackController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);

        return view('buyback.index');
    }

    public function buybackDataTable(Request $request)
    {
        $this->authorize('viewAny', Product::class);

        $invoiceNumber = $request->invoice_number;
        $code = $request->code;

        $productQuery = Product::query()
        ->select([
            'products.id',
            DB::raw("COALESCE(split.split_set_code, products.code) as code"),
            'split.split_set_code',
            'split.id as split_id',
            'products.price',
            'products.image',
            'products.name',
            'products.discount',
            DB::raw("COALESCE(split.created_at, products.created_at) as created_at"),
            'products.tag_type_id',
            'products.gramasi_id',
            'product_property_id',
            'products.mg',
            'product_status',
            'products.invoice_number'
        ])
        ->leftJoin('product_split_set_detail as split', 'products.id', '=', 'split.product_id')
        ->where('is_active', true)
        ->where('product_status', 0)
        ->when($invoiceNumber || $code, function ($query) use ($invoiceNumber, $code) {
            return $query->where(function ($query) use ($invoiceNumber, $code) {
                if ($invoiceNumber) {
                    $query->orWhere('invoice_number', $invoiceNumber);
                }
                if ($code) {
                    $query->orWhere('code', $code);
                }
            });
        });

        $productQuery = $productQuery
        ->orderByDesc('products.created_at')
        ->with([
            'tagType:id,code,color',
            'productProperty:id,code,description',
            'gramasi:id,code,gramasi'
        ])
        ->get();


        $datatable =  DataTables::of($productQuery)
            ->addIndexColumn()
            ->editColumn('created_at', fn ($product) => date('d M Y', strtotime($product->created_at)))
            ->editColumn('price', fn ($product) => $product->price )
            ->addColumn('product_property_description', fn ($product) => $product->productProperty->description ?? "-")
            ->addColumn('product_property_code', fn ($product) => $product->productProperty->code ?? "-")
            ->addColumn('gramasi_gramasi', fn ($product) => $product->gramasi->gramasi ?? "-")
            ->addColumn('tag_type_code', fn ($product) => $product->tagType->code ?? "-")
            ->addColumn('gramasi_code', fn ($product) => $product->gramasi->code ?? "-")
            ->addColumn('product_status', function ($product) {
                return $product->product_status == 1 ? 'STORE' : 'SOLD';
            })
            ->addColumn('invoice_number', function ($product) {
                return $product->invoice_number ?? "-";
            })
            ->addColumn('image_preview', function($q) {
                return '<img src="'.asset($q->image).'" class="img-thumbnail" width="100" height="100">';
            })
            ->addColumn('tag_type_color', function ($product) {
                $color = $product->tagType->color ?? "none";
                return '<div class="h-100 w-100" style="background-color: ' . $color . '">' . $color . '</div>';
            })
            ->addColumn('action', function ($product) {
                $user = auth()->user();
                
                $btnBuyBack = '<a class="dropdown-item btn-buyback" href="#"><i class="fa fa-arrow-left"></i> Buy Back</a>';

                $element =
                '<div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        '. $btnBuyBack.
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
        $result = Product::select('invoice_number')->where('product_status', 0)->where('is_active', true)->get();

        return response()->json($result);
    }

    public function getCode(Request $request)
    {
        $result = Product::select('code')->where('product_status', 0)->where('is_active', true)->get();
        return response()->json($result);
    }

}
