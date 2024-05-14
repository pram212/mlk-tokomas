<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Helpers\ResponseHelpers;


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
            ->addColumn('categories', function($q) { 
                return $q->categories->name ?? "-";
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'color'])
            ->toJson();
    }

    public function create()
    {
        $productCategories = Category::where('is_active', true)->get();
        return view('product_type.form', compact('productCategories'));
    }

    public function edit($id)
    {
        $productCategories = Category::where('is_active', true)->get();
        $productType = ProductType::findOrFail($id);

        return view('product_type.form', compact('productType', 'productCategories'));
    }

    public function store(StoreProductTypeRequest $request)
    {
        try {
            DB::beginTransaction();
            
    
            ProductType::create([
                'code' => $request->code,
                'description' => $request->description,
                'categories_id' => $request->categories_id,
            ]);

            DB::commit();
    
            return redirect('product-categories/producttype')->with('create_message', __('file.Data saved successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();
            throw $exception;

            return back()->with('message', $exception->getMessage());
        }
        
    }

    public function update(UpdateProductTypeRequest $request, $id)
    {

        try {
            DB::beginTransaction();


            $productType = ProductType::find($id);
    
            $productType->update([
                'code' => $request->code,
                'description' => $request->description,
                'categories_id' => $request->categories_id,
            ]);

            DB::commit();
    
            return redirect('product-categories/producttype')->with('create_message', __('file.Data updated successfully'));

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
                return ResponseHelpers::formatResponse(__('file.Failed to be deleted because it was used by grammar'), [], 403,false);
            }
            
            $productType->delete();

            DB::commit();

            return ResponseHelpers::formatResponse(__('file.Data deleted successfully'), []);

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
            
            return ResponseHelpers::formatResponse(__('file.The data was successfully deleted and those related to GRAMASI were not deleted'), []);

        } catch (\Exception $exception) {

            Db::rollBack();
            
            return ResponseHelpers::formatResponse($exception->getMessage(), [], 500,false);
        }

    }

     // get product type by category
     public function getByCategory($categories_id)
     {
        $response = [];
         try {
             $productType = ProductType::where('categories_id', $categories_id)->get();
                $response = [
                    'status' => 'success',
                    'data' => $productType
                ];
         } catch (\Exception $exception) {
                $response = [
                    'status' => 'error',
                    'message' => $exception->getMessage()
                ];
         }
         
            return response()->json($response);
     }


}
