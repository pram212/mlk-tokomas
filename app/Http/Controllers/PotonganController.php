<?php

namespace App\Http\Controllers;

use App\Potongan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseHelpers;

class PotonganController extends Controller
{
    public function index()
    {
        return view('potongan.index');
    }

    public function potonganData(Request $request)
    {
        $model = Potongan::query();

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
                            <a href="'. route('master.potongan.edit', $model->id) .'" class="btn btn-link"><i class="fa fa-pencil"></i>  '.__('file.edit').' </a>
                        </li>
                        <li>
                            <button type="button" class="btn btn-link view btn-delete"><i class="fa fa-trash"></i>  '.__('file.delete').'</button>
                        </li>
                    <ul>
                </div>';

                return $action;
            })
            // ->addColumn('category', function($model) {
            //     return @$model->category->name;
            // })
            // ->addColumn('product_type', function($model) {
            //     return @$model->productType->code . " - " . @$model->productType->description;
            // })
            ->addIndexColumn()
            ->rawColumns(['action', 'color'])
            ->toJson();
    }

    public function create()
    {
        $subTitle = __('file.Add Discount');
        return view('potongan.form', compact('subTitle'));
    }

    public function edit($id)
    {
        $potongan = Potongan::findOrFail($id);
        $subTitle = __('file.Edit Discount');
        return view('potongan.form', compact('potongan', 'subTitle'));
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            Potongan::create($request->all());

            DB::commit();

            return redirect('master/potongan')->with('create_message', __('file.Data saved successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }

    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            $potongan = Potongan::find($id);

            $potongan->update([
                'discount' => $request->discount,
                'code' => $request->code,
            ]);

            DB::commit();

            return redirect('master/potongan')->with('create_message', __('file.Data updated successfully'));

        } catch (\Exception $exception) {

            DB::rollBack();

            return back()->with('message', $exception->getMessage());
        }

    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Potongan::destroy($id);

            DB::commit();

            return ResponseHelpers::formatResponse(__('file.Data deleted successfully'), []);

        } catch (\Exception $exception) {
            Db::rollBack();

            return ResponseHelpers::formatResponse($exception->getMessage(), [], 500,false);

        }

    }

    public function destroyMultiple(Request $request)
    {
        try {
            DB::beginTransaction();

            Potongan::destroy($request->ids);

            DB::commit();

            return ResponseHelpers::formatResponse(__('file.Data deleted successfully'), []);

        } catch (\Exception $exception) {

            Db::rollBack();

            return ResponseHelpers::formatResponse($exception->getMessage(), [], 500,false);
        }

    }

    function getValueDiscount($id) {
        $getDiscount = DB::table('potongan')->where('id', '=', $id)->first();

        return response()->json($getDiscount);
    }
}
