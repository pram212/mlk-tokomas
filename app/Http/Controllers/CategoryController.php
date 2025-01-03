<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Gramasi;
use App\Helpers\ResponseHelpers;

class CategoryController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $lims_categories = Category::where('is_active', true)->pluck('name', 'id');
        $lims_category_all = Category::where('is_active', true)->get();
        return view('category.create',compact('lims_categories', 'lims_category_all'));
    }

    public function categoryDatatable(Request $request)
    {
        // $modeData = $request->modeData ? $request->modeData : 'index';
        // $isActive = $modeData == 'index' ? true : false;
        $isActive = true;

        $categories = Category::query()
            ->where('is_active', $isActive);

        return DataTables::of($categories)
                ->addColumn('options', function($category) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                        <li>
                            <button type="button" data-id="'.$category->id.'" class="open-EditCategoryDialog btn btn-link" data-toggle="modal" data-target="#editModal" ><i class="dripicons-document-edit"></i> '.trans("file.edit").'</button>
                        </li>
                        <li class="divider"></li>
                        <li>
                          <button class="btn btn-link" onclick="confirmDeletes('.$category->id.')"><i class="dripicons-trash"></i> '.trans("file.delete").'</button>
                        </li>
                    </ul>
                </div>';
                })
                ->rawColumns(['options'])
                ->make(true);

    }

    public function store(Request $request)
    {
        $request->name = preg_replace('/\s+/', ' ', $request->name);
        $this->validate($request, [
            'name' => [
                'max:255',
                    Rule::unique('categories')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            // 'image' => 'image|mimes:jpg,jpeg,png,gif',
        ]);

        $lims_category_data['name'] = $request->name;
        $lims_category_data['width'] = $request->width;
        $lims_category_data['height'] = $request->height;
        $lims_category_data['tipe'] = $request->tipe;
        $lims_category_data['is_active'] = true;
        Category::create($lims_category_data);
        return redirect('category')->with('message', 'Category inserted successfully');
    }

    public function edit($id)
    {
        $lims_category_data = Category::findOrFail($id);

        if(str_contains($lims_category_data->width, '.00')) {
            $isWidth = str_replace('.00', '', $lims_category_data->width);
            $finalWidth = (int)$isWidth;
        } else {
            $isWidth = str_replace('0', '', $lims_category_data->width);
            $finalWidth = (float)$isWidth;
        }
        if(str_contains($lims_category_data->height, '.00')) {
            $isHeight = str_replace( '.00', '', $lims_category_data->height);
            $finalHeight = (int)$isHeight;
        } else {
            $isHeight = str_replace('0', '', $lims_category_data->height);
            $finalHeight = (float)$isHeight;
        }

        $lims_category_data['width'] = $finalWidth;
        $lims_category_data['height'] = $finalHeight;

        return $lims_category_data;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => [
                'max:255',
                Rule::unique('categories')->ignore($id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            'image' => 'image|mimes:jpg,jpeg,png,gif',
        ]);

        $input = $request->except('image');
        $image = $request->image;
        if ($image) {
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '.' . $ext;
            $image->move('public/images/category', $imageName);
            $input['image'] = $imageName;
        }
        $lims_category_data = Category::findOrFail($id);
        $lims_category_data->update($input);
        return redirect('category')->with('message', 'Category updated successfully');
    }

    public function import(Request $request)
    {
        //get file
        $upload=$request->file('file');
        $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
        if($ext != 'csv')
            return redirect()->back()->with('not_permitted', 'Please upload a CSV file');
        $filename =  $upload->getClientOriginalName();
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
        $escapedHeader=[];
        //validate
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        //looping through othe columns
        while($columns=fgetcsv($file))
        {
            if($columns[0]=="")
                continue;
            foreach ($columns as $key => $value) {
                $value=preg_replace('/\D/','',$value);
            }
            $data= array_combine($escapedHeader, $columns);
            $category = Category::firstOrNew(['name' => $data['name'], 'is_active' => true ]);

            $category->is_active = true;
            $category->save();
        }
        return redirect('category')->with('message', 'Category imported successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $category_id = $request['categoryIdArray'];

        // check if category has products
        $productCount = Product::whereIn('category_id', $category_id)->count();
        if ($productCount > 0) {
            return response()->json(['status' => 'error', 'code'=>500,'message' => 'Category has products. Please delete products first']);
        }

        // check if category has gramasis
        $category = Gramasi::whereIn('categories_id', $category_id)->first();
        if ($category) {
            return response()->json(['status' => 'error', 'code'=>500,'message' => 'Category has gramasis. Please delete gramasis first']);
        }

        Category::whereIn('id', $category_id)->delete();

        return response()->json(['status' => 'success', 'code'=>200,'message' => 'Category deleted successfully']);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Periksa apakah kategori memiliki produk
            $productCount = Product::where('category_id', $id)->count();

            if ($productCount > 0) {
                throw new \Exception('Category has products. Please delete products first');
            }

            // check if category has gramasis
            $category = Gramasi::where('categories_id', $id)->first();
            if ($category) {
                throw new \Exception('Category has gramasis. Please delete gramasis first');
            }

            // Hapus kategori secara permanen
            Category::findOrFail($id)->delete();

            DB::commit();

            // return json response
            return response()->json([
                'status' => 'success',
                'code' => '200',
                'message' => 'Category deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // return json response
            return response()->json([
                'status' => 'error',
                'code' => '500',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show ($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }


    // hard delete
    // public function delete($id)
    // {
    //     $lims_category_data = Category::findOrFail($id);
    //     if($lims_category_data->image)
    //         unlink('public/images/category/'.$lims_category_data->image);
    //     $lims_category_data->delete();
    //     return redirect('category')->with('message', 'Category has been deleted');
    // }

      // get warehouse list
    // [GET] /sales/warehouse
    public function categoryList()
    {
        try {
            $lims_category_list = Category::where('is_active', true)->get();
            return ResponseHelpers::formatResponse('success', $lims_category_list, 200);
        } catch (\Exception $e) {
            return ResponseHelpers::formatResponse('error : ' . $e->getMessage(), [], 500, false);
        }
    }
}
