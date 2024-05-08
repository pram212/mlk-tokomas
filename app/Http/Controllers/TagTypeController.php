<?php

namespace App\Http\Controllers;

use App\TagType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTagTypeRequest;
use App\Http\Requests\UpdateTagTypeRequest;
use App\Product;
use App\Price;

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
                            <a href="'. route('product-categories.tagtype.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  '.__('file.edit').' </a>
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

    public function store(StoreTagTypeRequest $request)
    {
        try {
            DB::beginTransaction();
    
            TagType::create([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            DB::commit();
    
            return redirect('product-categories/tagtype')->with('create_message', __('file.Data saved successfully'));

        } catch (\Exception $exception) {
            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }

    public function update(UpdateTagTypeRequest $request, $id)
    {

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

            return redirect('product-categories/tagtype')->with('message', $exception->getMessage());
        }
        
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            // check if tag type has products
            $productCount = Product::where('tag_type_id', $id)->count();
            if ($productCount > 0) {
                return response()->json(['status' => 'error', 'code'=>500,'message' => 'Tag type has products. Please delete products first']);
            }

            // check if tag type has prices
            $tagType = Price::where('tag_type_id', $id)->first();
            if ($tagType) {
                return response()->json(['status' => 'error', 'code'=>500,'message' => 'Tag type has prices. Please delete prices first']);
            }

            TagType::destroy($id);

            DB::commit();

            return response()->json(['status' => 'success', 'code'=>200,'message' => 'Tag type deleted successfully']);

        } catch (\Exception $exception) {
            Db::rollBack();

            return response()->json(['status' => 'error', 'code'=>500,'message' => $exception->getMessage()]);

        }
        
    }

    public function destroyMultiple(Request $request)
    {
        try {
            DB::beginTransaction();

            // check if tag type has products
            $productCount = Product::whereIn('tag_type_id', $request->ids)->count();
            if ($productCount > 0) {
                return response()->json(['status' => 'error', 'code'=>500,'message' => 'Tag type has products. Please delete products first']);
            }

            // check if tag type has prices
            $tagType = Price::whereIn('tag_type_id', $request->ids)->first();
            if ($tagType) {
                return response()->json(['status' => 'error', 'code'=>500,'message' => 'Tag type has prices. Please delete prices first']);
            }
            
            TagType::destroy($request->ids);

            DB::commit();

            return response()->json(['status' => 'success', 'code'=>200,'message' => 'Tag type deleted successfully']);

        } catch (\Exception $exception) {

            Db::rollBack();
            
            return response()->json(['status' => 'error', 'code'=>500,'message' => $exception->getMessage()]);
        }

    }

}
