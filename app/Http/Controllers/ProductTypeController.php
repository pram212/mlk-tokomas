<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProductTypeController extends Controller
{
    public function index()
    {
        return view('product_type.index');
    }

    public function productTypeData(Request $request)
    {
        $model = ProductType::query();

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
                            <a href="'. route('product-categories.producttype.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  '.__('file.edit').' </a>
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
        return view('product_type.form');
    }

    public function edit($id)
    {
        $productType = ProductType::findOrFail($id);

        return view('product_type.form', compact('productType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'description' => ['required'],

        ]);

        try {
            DB::beginTransaction();
            
    
            ProductType::create([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            DB::commit();
    
            return redirect('producttype')->with('create_message', __('file.Data saved successfully'));

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


            $productType = ProductType::find($id);
    
            $productType->update([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            DB::commit();
    
            return redirect('producttype')->with('create_message', __('file.Data updated successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $productType = ProductType::find($id);

            if ($productType->gramasi->count() > 0) {
                return response(__('file.Failed to be deleted because it was used by grammar'), 403);
            }
            
            $productType->delete();

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
            
            ProductType::whereIn('id', $request->ids)->doesntHave('gramasi')->delete();

            DB::commit();

            return response(__('file.The data was successfully deleted and those related to GRAMASI were not deleted'), 200);

        } catch (\Exception $exception) {

            Db::rollBack();
            
            return response($exception->getMessage(), 500);
        }

    }


}
