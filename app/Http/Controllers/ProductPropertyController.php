<?php

namespace App\Http\Controllers;

use App\ProductProperty;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProductPropertyController extends Controller
{
    public function index()
    {
        return view('product_property.index');
    }

    public function productPropertyData(Request $request)
    {
        $model = ProductProperty::query();

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
                            <a href="'. route('product-categories.productproperty.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  '.__('file.edit').' </a>
                        </li>
                        <li>
                            <button type="button" class="btn btn-link view btn-delete"><i class="fa fa-trash"></i>  '.__('file.delete').'</button>
                        </li>
                    <ul>
                </div>';
               
                return $action;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'color'])
            ->toJson();
    }

    public function create()
    {
        return view('product_property.form');
    }

    public function edit($id)
    {
        $productProperty = ProductProperty::findOrFail($id);

        return view('product_property.form', compact('productProperty'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'description' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            
            ProductProperty::create([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            DB::commit();
    
            return redirect('product-categories/productproperty')->with('create_message', __('file.Data saved successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => ['required'],
            'description' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $productProperty = ProductProperty::find($id);
    
            $productProperty->update([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            DB::commit();
    
            return redirect('product-categories/productproperty')->with('create_message', __('file.Data updated successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            ProductProperty::destroy($id);

            DB::commit();

            return response(__('file.The data was successfully deleted'), 200);

        } catch (\Exception $exception) {

            Db::rollBack();

            return response($exception->getMessage(), 500);

        }
        
    }

    public function destroyMultiple(Request $request)
    {
        try {
            DB::beginTransaction();
            
            ProductProperty::destroy($request->ids);

            DB::commit();

            return response(__('file.Data deleted successfully'), 200);

        } catch (\Exception $exception) {

            Db::rollBack();
            
            return response($exception->getMessage(), 500);
        }

    }


}
