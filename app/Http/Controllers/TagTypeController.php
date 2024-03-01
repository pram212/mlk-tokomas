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
                            <a href="'. route('tagtype.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  '.__('file.edit').' </a>
                        </li>
                        <li>
                            <button type="button" class="btn btn-link view btn-delete"><i class="fa fa-trash"></i>  '.__('file.delete').'</button>
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
        $request->validate([
            'code' => ['required'],
            'color' => ['required'],
            'description' => ['required'],

        ]);

        try {
            DB::beginTransaction();
    
            TagType::create([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            DB::commit();
    
            return redirect('tagtype')->with('create_message', __('file.Data saved successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => ['required'],
            'color' => ['required'],
            'description' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $tagType = TagType::find($id);
    
            $tagType->update([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            DB::commit();
    
            return back()->with('create_message', __('file.Data updated successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return redirect('tagtype')->with('message', $exception->getMessage());
        }
        
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            TagType::destroy($id);

            DB::commit();

            return response()->json(__('file.The data was successfully deleted'), 200);

        } catch (\Exception $exception) {
            Db::rollBack();

            return response()->json($exception->getMessage(), 500);

        }
        
    }

    public function destroyMultiple(Request $request)
    {
        try {
            DB::beginTransaction();
            
            TagType::destroy($request->ids);

            DB::commit();

            return response(__('file.Data deleted successfully'), 200);

        } catch (\Exception $exception) {

            Db::rollBack();
            
            return response($exception->getMessage(), 500);
        }

    }

}
