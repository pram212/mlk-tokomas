<?php

namespace App\Http\Controllers;

use App\Gramasi;
use App\ProductType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Http\Requests\StoreGramasiRequest;

class GramasiController extends Controller
{
    public function index()
    {
        return view('gramasi.index');
    }

    public function gramasiData(Request $request)
    {
        $model = Gramasi::query();

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
                            <a href="'. route('product-categories.gramasi.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  '.__('file.edit').' </a>
                        </li>
                        <li>
                            <button type="button" class="btn btn-link view btn-delete"><i class="fa fa-trash"></i>  '.__('file.delete').'</button>
                        </li>
                    <ul>
                </div>';
               
                return $action;
            })
            ->addColumn('category', function($model) {
                return @$model->category->name;
            })
            ->addColumn('product_type', function($model) {
                return @$model->productType->code . " - " . @$model->productType->description;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'color'])
            ->toJson();
    }

    public function create()
    {
        $category = Category::all();

        return view('gramasi.form', compact('category'));
    }

    public function edit($id)
    {
        $gramasi = Gramasi::findOrFail($id)->load('productType');

        $productType = ProductType::select('id', 'code', 'description')->get();

        return view('gramasi.form', compact('gramasi', 'productType'));
    }

    public function store(StoreGramasiRequest $request)
    {

        try {
            DB::beginTransaction();
    
            Gramasi::create([
                'categories_id' => $request->categories_id,
                'product_type_id' => $request->product_type_id,
                'gramasi' => $request->gramasi,
                'code' => $request->code,
            ]);

            DB::commit();
    
            return redirect('product-categories/gramasi')->with('create_message', __('file.Data saved successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_type_id' => ['required'],
            'gramasi' => ['required', 'numeric'],
            'code' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $gramasi = Gramasi::find($id);
    
            $gramasi->update([
                'product_type_id' => $request->product_type_id,
                'gramasi' => $request->gramasi,
                'code' => $request->code,
            ]);

            DB::commit();
    
            return redirect('gramasi')->with('create_message', __('file.Data updated successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            Gramasi::destroy($id);

            DB::commit();

            return response()->json(__('file.Data deleted successfully'), 200);

        } catch (\Exception $exception) {
            Db::rollBack();

            return response()->json($exception->getMessage(), 500);

        }
        
    }

    public function destroyMultiple(Request $request)
    {
        try {
            DB::beginTransaction();
            
            Gramasi::destroy($request->ids);

            DB::commit();

            return response(__('file.Data deleted successfully'), 200);

        } catch (\Exception $exception) {

            Db::rollBack();
            
            return response($exception->getMessage(), 500);
        }

    }

   



}
