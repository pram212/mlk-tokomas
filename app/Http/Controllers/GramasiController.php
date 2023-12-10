<?php

namespace App\Http\Controllers;

use App\Gramasi;
use App\ProductType;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

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
                            <a href="'. route('gramasi.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  Edit </a>
                        </li>
                        <li>
                            <button type="button" class="btn btn-link view btn-delete"><i class="fa fa-trash"></i>  Hapus</button>
                        </li>
                    <ul>
                </div>';
               
                return $action;
            })
            ->addColumn('product_type', function($model) {
                return $model->productType->code . " - " . $model->productType->description;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'color'])
            ->toJson();
    }

    public function create()
    {
        $productType = ProductType::select('id', 'code', 'description')->get();

        return view('gramasi.form', compact('productType'));
    }

    public function edit($id)
    {
        $gramasi = Gramasi::findOrFail($id)->load('productType');

        $productType = ProductType::select('id', 'code', 'description')->get();

        return view('gramasi.form', compact('gramasi', 'productType'));
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            
            $request->validate([
                'product_type_id' => ['required'],
                'freetext' => ['required'],
    
            ]);
    
            Gramasi::create([
                'product_type_id' => $request->product_type_id,
                'freetext' => $request->freetext,
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
                'product_type_id' => ['required'],
                'freetext' => ['required'],
            ]);

            $gramasi = Gramasi::find($id);
    
            $gramasi->update([
                'dproduct_type_id' => $request->product_type_id,
                'freetext' => $request->freetext,
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
            
            Gramasi::destroy($id);

            DB::commit();

            return response()->json('data berhasil dihapus', 200);

        } catch (\Exception $exception) {
            Db::rollBack();

            return response()->json($exception->getMessage(), 500);

        }
        
    }


}
