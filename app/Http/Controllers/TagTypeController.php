<?php

namespace App\Http\Controllers;

use App\TagType;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TagTypeController extends Controller
{
    public function index()
    {
        // if (Gate::allows('lihat-produk')) {
        //     dd('punya akses lihat produk');
        // } else {
        //     dd('gak punya akses lihat produk');
        // }

        return view('tag_type.index');
    }

    public function tagTypeData(Request $request)
    {
        $model = TagType::query();

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
                            <a href="'. route('tagtype.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  Edit </a>
                        </li>
                        <li>
                            <button type="button" class="btn btn-link view btn-delete"><i class="fa fa-trash"></i>  Hapus</button>
                        </li>
                    <ul>
                </div>';
               
                return $action;
            })
            ->editColumn('color', function($model) {
                return '<span style="background-color: '. $model->color .'; height:20px; width: 70%;"></span>';
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'color'])
            ->toJson();
    }

    public function create()
    {
        return view('tag_type.form');
    }

    public function edit($id)
    {
        $tagType = TagType::findOrFail($id);

        return view('tag_type.form', compact('tagType'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $request->validate([
                'code' => ['required'],
                'color' => ['required'],
                'description' => ['required'],
    
            ]);
    
            TagType::create([
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
                'color' => ['required'],
                'description' => ['required'],
            ]);

            $tagType = TagType::find($id);
    
            $tagType->update([
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
            
            TagType::destroy($id);

            DB::commit();

            return response()->json('data berhasil dihapus', 200);

        } catch (\Exception $exception) {
            Db::rollBack();

            return response()->json($exception->getMessage(), 500);

        }
        
    }


}
