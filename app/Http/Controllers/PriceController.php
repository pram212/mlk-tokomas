<?php

namespace App\Http\Controllers;

use App\Gramasi;
use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Price;
use App\ProductProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use App\Category;
use App\TagType;
use App\PriceProductPropertyDetail;
use App\ProductType;
use App\Helpers\ResponseHelpers;

class PriceController extends Controller
{
    public function index()
    {
        return view('price.index');
    }

    public function priceData()
    {
        $model = Price::query();

        return DataTables::of($model)
            ->addColumn('action', function ($model) {
                $action = 
                '<div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                        <li>
                            <a href="'. route('master.price.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  '.__('file.edit').' </a>
                        </li>
                        <li>
                            <button type="button" class="btn btn-link view btn-delete"><i class="fa fa-trash"></i>  '.__('file.delete').'</button>
                        </li>
                    <ul>
                </div>';
               
                return $action;
            })
            ->addColumn('gramasi', function($q) { 
                return $q->gramasi->gramasi ?? "-";
            })
            ->addColumn('product_type', function($q) { 
                return ($q->product_type->code ?? '') ." - ". ($q->product_type->description ?? '');
            })
            ->addColumn('tag_type', function($q) { 
                return $q->tagType->code ?? "-";
            })
            ->addColumn('categories', function($q) { 
                return $q->categories->name ?? "-";
            })
            ->editColumn('created_by', function($q) { 
                return $q->createdBy?  $q->createdBy->name : "-";
            })
            ->editColumn('updated_by', function($q) { 
                return $q->updatedBy? $q->updatedBy->name : "-";
            })
            ->editColumn('created_at', function($q) {
                return date('d/m/Y', strtotime($q->created_at));
            })
            ->editColumn('updated_at', function($q) {
                return date('d/m/Y', strtotime($q->updated_at));
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        $productProperty = ProductProperty::all();
        $category = Category::where('is_active', true)->get();
        $tagType = TagType::all();

        return view('price.form', compact('productProperty', 'category', 'tagType'));
    }

    public function edit($id)
    {
        $gramasi = Gramasi::all();
        $productProperty = ProductProperty::all();
        $product_property_price = PriceProductPropertyDetail::where('price_id', $id)->get();
        $category = Category::where('is_active', true)->get();
        $tagType = TagType::all();
        $price = Price::findOrFail($id);
        $product_type = ProductType::where('categories_id', $price->categories_id)->get();

        return view('price.form', compact('price', 'gramasi', 'productProperty', 'category', 'tagType', 'product_property_price', 'product_type'));
    }

    public function store(StorePriceRequest $request)
    {
        try {
            DB::beginTransaction();
            
            Price::create([
                // 'price' =>  moneyToNumeric($request->price, ","),
                'gramasi_id' => $request->gramasi_id,
                'tag_type_id' => $request->tag_type_id,
                'categories_id' => $request->categories_id,
                'product_type_id' => $request->product_type_id,
                'carat' => $request->carat,
                'created_by' => auth()->id()
            ]);
            $price_created_id = Price::latest()->first()->id;
            $productPropertyPrice = $request->product_property_price;

            foreach ($productPropertyPrice as $productPropertyId => $price) {
                PriceProductPropertyDetail::create([
                    'price_id' => $price_created_id,
                    'product_property_id' => $productPropertyId,
                    'price' => moneyToNumeric($price, ","),
                    'created_by' => auth()->id()
                ]);
            }


            DB::commit();
    
            return redirect('master/price')->with(['type' => 'alert-success', 'message' => __('file.Data saved successfully')]);

        } catch (\Exception $exception) {

            DB::rollBack();

            throw $exception;

            return back()->with(['type' => 'alert-danger', 'message', $exception->getMessage()]);
        }
        
    }

    public function update(UpdatePriceRequest $request, $id)
    { 
        try {
            DB::beginTransaction();

            $price = Price::find($id);
            
            $price->update([
                // 'price' => moneyToNumeric($request->price, ","),
                'gramasi_id' => $request->gramasi_id,
                'carat' => $request->carat,
                'tag_type_id' => $request->tag_type_id,
                'categories_id' => $request->categories_id,
                'product_type_id' => $request->product_type_id,
                'updated_by' => auth()->id()
            ]);

            $productPropertyPrice = $request->product_property_price;

            foreach ($productPropertyPrice as $productPropertyId => $price) {
                $productPropertyPrice = PriceProductPropertyDetail::where('price_id', $id)->where('product_property_id', $productPropertyId)->first();
                if ($productPropertyPrice) {
                    $productPropertyPrice->update([
                        'price' => moneyToNumeric($price, ","),
                        'updated_by' => auth()->id()
                    ]);
                } else {
                    PriceProductPropertyDetail::create([
                        'price_id' => $id,
                        'product_property_id' => $productPropertyId,
                        'price' => moneyToNumeric($price, ","),
                        'created_by' => auth()->id()
                    ]);
                }
            }



            DB::commit();
            return redirect('master/price')->with(['type' => 'alert-success', 'message' => __('file.Data saved successfully')]);

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with(['type' => 'alert-danger', 'message', $exception->getMessage()]);
        }
        
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $priceProductPropertyDetail = PriceProductPropertyDetail::where('price_id', $id)->delete();
            $price = Price::find($id);
            
            $price->delete();
            DB::commit();

            return ResponseHelpers::formatResponse(__('file.Data deleted successfully'), []);

        } catch (\Exception $exception) {

            Db::rollBack();

            return ResponseHelpers::formatResponse($exception->getMessage(), [], 500,false);

        }
        
    }

    public function destroyMultiple(Request $request)
    {
        try {
            DB::beginTransaction();
            
            PriceProductPropertyDetail::whereIn('price_id', $request->ids)->delete();
            Price::whereIn('id', $request->ids)->delete();


            DB::commit();

            return ResponseHelpers::formatResponse(__('file.Data deleted successfully'), []);

        } catch (\Exception $exception) {

            Db::rollBack();
            
            return ResponseHelpers::formatResponse($exception->getMessage(), [], 500,false);
        }

    }

    // get price by categories_id and product_type_id
    public function getProductPrice(Request $request,$categories_id, $product_type_id,$product_property_id)
    {
        $price = Price::where('categories_id', $categories_id)->where('product_type_id', $product_type_id)->get();
        $product_property_price = PriceProductPropertyDetail::where('price_id', $price[0]->id)->where('product_property_id', $product_property_id)->first();
        
        return response()->json($product_property_price);
    }
}
