<?php

namespace App\Http\Controllers;

use App\Gramasi;
use App\ProductBasOnTag;
use App\ProductProperty;
use App\ProductType;
use App\TagType;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class ProductBaseOnTagController extends Controller
{
    public function index()
    {
        $productBaseOnTags = ProductBasOnTag::with(['tagType:id,code,color', 'productType:id,code', 'productProperty:id,code', 'gramasi:id,code,gramasi'])->paginate(9);

        return view('product_base_on_tag.index', compact('productBaseOnTags'));
    }

    public function productTypeData(Request $request)
    {
        $model = ProductBasOnTag::query();

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
                            <a href="'. route('producttype.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  '.__('file.edit').' </a>
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
        $tagType = TagType::all();
        $productType = ProductType::all();
        $productProperty = ProductProperty::all();
        $gramasi = Gramasi::all();

        return view('product_base_on_tag.form', compact('tagType','productType', 'productProperty', 'gramasi'));
    }

    public function edit($id)
    {
        $productBaseOnTag = ProductBasOnTag::findOrFail($id)->load(['gramasi', 'tagType']);
        $tagType = TagType::all();
        $productType = ProductType::all();
        $productProperty = ProductProperty::all();
        $gramasi = Gramasi::all();

        return view('product_base_on_tag.form', compact('productBaseOnTag', 'tagType','productType', 'productProperty', 'gramasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag_type_id' => ['required'],
            'product_property_id' => ['required'],
            'gramasi_id' => ['required'],
            'product_type_id' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            
            ProductBasOnTag::create([
                'tag_type_id' => $request->tag_type_id,
                'product_property_id' => $request->product_property_id,
                'gramasi_id' => $request->gramasi_id,
                'product_type_id' => $request->product_type_id,
                'mg' => $request->mg,
            ]);

            DB::commit();
    
            return back()->with('create_message', __('file.Data saved successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return redirect('productbaseontag')->with('message', $exception->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tag_type_id' => ['required'],
            'product_property_id' => ['required'],
            'gramasi_id' => ['required'],
            'product_type_id' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $productType = ProductBasOnTag::find($id);
    
            $productType->update([
                'tag_type_id' => $request->tag_type_id,
                'product_property_id' => $request->product_property_id,
                'gramasi_id' => $request->gramasi_id,
                'product_type_id' => $request->product_type_id,
                'mg' => $request->mg,
                'mg' => $request->mg,
            ]);

            DB::commit();
    
            return redirect('productbaseontag')->with('create_message', __('file.Data updated successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }
        
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $productType = ProductBasOnTag::find($id);

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
            
            ProductBasOnTag::whereIn('id', $request->ids)->doesntHave('gramasi')->delete();

            DB::commit();

            return response(__('file.The data was successfully deleted and those related to GRAMASI were not deleted'), 200);

        } catch (\Exception $exception) {

            Db::rollBack();
            
            return response($exception->getMessage(), 500);
        }

    }


}
