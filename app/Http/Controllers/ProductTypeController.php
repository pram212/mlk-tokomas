<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use DataTables;
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
                            <a href="'. route('producttype.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  Edit </a>
                        </li>
                        <li>
                            <button type="button" class="btn btn-link view btn-delete"><i class="fa fa-trash"></i>  Hapus</button>
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
        try {
            DB::beginTransaction();
            
            $request->validate([
                'code' => ['required'],
                'description' => ['required'],
    
            ]);
    
            ProductType::create([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            DB::commit();
    
            return back()->with('create_message', 'Jenis tag berhasil disimpan');

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'code' => ['required'],
                'description' => ['required'],
            ]);

            $productType = ProductType::find($id);
    
            $productType->update([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            DB::commit();
    
            return back()->with('create_message', 'Jenis tag berhasil diupdate');

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            ProductType::destroy($id);

            DB::commit();

            return response()->json('data berhasil dihapus', 200);

        } catch (\Exception $exception) {
            Db::rollBack();

            return response()->json($exception->getMessage(), 500);

        }
        
    }


}
