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
            ->editColumn('price', function($q) {
                return number_format($q->price, 2, ',', '.');
            })
            ->addColumn('gramasi', function($q) { 
                return $q->gramasi->gramasi;
            })
            ->addColumn('property', function($q) { 
                return $q->productProperty->code ?? "-";
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
        $gramasi = Gramasi::all();
        $productProperty = ProductProperty::all();

        return view('price.form', compact('gramasi', 'productProperty'));
    }

    public function edit($id)
    {
        $gramasi = Gramasi::all();
        $productProperty = ProductProperty::all();
        $price = Price::findOrFail($id);

        return view('price.form', compact('price', 'gramasi', 'productProperty'));
    }

    public function store(StorePriceRequest $request)
    {
        try {
            DB::beginTransaction();
        
            Price::create([
                'price' =>  moneyToNumeric($request->price, ","),
                'gramasi_id' => $request->gramasi_id,
                'product_property_id' => $request->product_property_id,
                'created_by' => auth()->id()
            ]);

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
                'price' => moneyToNumeric($request->price, ","),
                'gramasi_id' => $request->gramasi_id,
                'product_property_id' => $request->product_property_id,
                'updated_by' => auth()->id()
            ]);

            DB::commit();
    
            return redirect('master/price')->with('create_message', __('file.Data updated successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $price = Price::find($id);
            
            $price->delete();

            DB::commit();

            return response(__('file.Data deleted successfully'), 200);

        } catch (\Exception $exception) {

            Db::rollBack();

            return response($exception->getMessage(), 500);

        }
        
    }

    public function destroyMultiple(Request $request)
    {
        try {
            DB::beginTransaction();
            
            Price::whereIn('id', $request->ids)->delete();

            DB::commit();

            return response(__('file.The data was successfully deleted and those related to GRAMASI were not deleted'), 200);

        } catch (\Exception $exception) {

            Db::rollBack();
            
            return response($exception->getMessage(), 500);
        }

    }
}
