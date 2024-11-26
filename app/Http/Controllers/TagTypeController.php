<?php

namespace App\Http\Controllers;

use App\GoldContentConvertion;
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
        $goldContentConversion = GoldContentConvertion::where('tag_types_id', '=', $id)->get();


        return view('tag_type.form', compact('tagType', 'goldContentConversion'));
    }

    public function store(StoreTagTypeRequest $request)
    {
        try {
            DB::beginTransaction();

            $tagId = TagType::create([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);


            // for($i= 0; $i <= count($request->conversion); $i++) {
            $conversion = $request->conversion;
            $result = $request->result;
            foreach($conversion as $key => $data) {
                GoldContentConvertion::create([
                    'tag_types_id' => $tagId->id,
                    'result' => '± '. $result[$key],
                    'gold_content' => $data
                ]);
            }

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

            // Update the main TagType record
            $tagType->update([
                'code' => $request->code,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            $goldConversion = GoldContentConvertion::where('tag_types_id', '=', $id)->get();


            foreach($request->conversion as $key => $vls) {
                $ifEdit = GoldContentConvertion::where('tag_types_id', '=', $id)->where('gold_content', '=', $vls)->get();
                if($ifEdit->isNotEmpty()) {
                     foreach ($goldConversion as $index => $data) {
                        // print_r($ifEdit);
                            // Make sure the index exists in the request arrays
                            if (isset($request->result[$index]) && isset($request->conversion[$index])) {
                                DB::table('gold_content_convertions')
                                    ->where('id', $data->id)
                                    ->update([
                                        'result' => '± ' . $request->result[$index],
                                        'gold_content' => $request->conversion[$index],
                                    ]);
                            }
                     }
                } else {
                    GoldContentConvertion::create([
                        'tag_types_id' => $id,
                        'result' => '± '. $request->result[$key],
                        'gold_content' => $request->conversion[$key]
                    ]);
                }
            }

            DB::commit();

            return redirect('product-categories/tagtype')->with('create_message', __('file.Data updated successfully'));

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
            GoldContentConvertion::where('tag_types_id',$id)->delete();

            DB::commit();

            return response()->json(['status' => 'success', 'code'=>200,'message' => 'Tag type and Gold Conversion deleted successfully']);

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
            GoldContentConvertion::where('tag_types_id',$request->ids)->delete();

            DB::commit();

            return response()->json(['status' => 'success', 'code'=>200,'message' => 'Tag type deleted successfully']);

        } catch (\Exception $exception) {

            Db::rollBack();

            return response()->json(['status' => 'error', 'code'=>500,'message' => $exception->getMessage()]);
        }

    }

}
