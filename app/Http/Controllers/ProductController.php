<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product_Warehouse;
use App\ProductProperty;
use App\ProductVariant;
use App\ProductType;
use App\Warehouse;
use App\Category;
use App\Product;
use App\Variant;
use App\Gramasi;
use App\TagType;
use App\Brand;
use App\Unit;
use DNS1D;
use Keygen;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);

        return view('product.index', compact('all_permission'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        $lims_category_list = Category::where('is_active', true)->get();
        $productProperty = ProductProperty::all();
        $productType = ProductType::all();
        $tagType = TagType::all();
        $gramasi = Gramasi::all();

        return view('product.create', compact(
            'lims_category_list',
            'productProperty',
            'productType',
            'tagType',
            'gramasi',
        ));
    }

    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', Product::class);

        try {
            DB::beginTransaction();

            $imagePath = 'zummXD2dvAtI.png';

            if ($request->file('image')) {
                $file = $request->file('image');
                $imagePath = "storage/app/" . $file->storeAs('product_images', time() . $request->file('image')->getClientOriginalName()); // Simpan file ke dalam folder 'uploads' 
            }

            $request->merge(['image' => $imagePath]);

            Product::create($request->all());

            DB::commit();

            return back()->with('create_message', 'Product created successfully');
        } catch (\Exception $ex) {

            DB::rollBack();

            return back()->with('create_message', $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $this->authorize('update', Product::class);

        $lims_category_list = Category::where('is_active', true)->get();
        $productProperty = ProductProperty::all();
        $productType = ProductType::all();
        $tagType = TagType::all();
        $gramasi = Gramasi::all();

        $product = Product::find($id)->load([
            'productProperty:id,code,description',
            'gramasi:id,code,gramasi',
            'tagType:id,code,color',
            'category'
        ]);

        return view('product.edit', compact(
            'lims_category_list',
            'productProperty',
            'productType',
            'tagType',
            'gramasi',
            'product'
        ));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $this->authorize('update', Product::class);

        $product = Product::find($id);

        try {

            DB::beginTransaction();

            $imagePath = 'zummXD2dvAtI.png';

            if ($request->file('image')) {
                $file = $request->file('image');
                $imagePath = "storage/app/" . $file->storeAs('product_images', time() . $request->file('image')->getClientOriginalName());
            }

            $request->merge(['image' => $imagePath]);

            $product->update($request->all());

            DB::commit();

            return back()->with('create_message', 'Product updated successfully');

        } catch (\Exception $ex) {

            DB::rollBack();

            return back()->with('create_message', $ex->getMessage());
        }
    }

    public function generateCode()
    {
        $id = Keygen::numeric(8)->generate();
        return $id;
    }

    public function search(Request $request)
    {
        $product_code = explode(" ", $request['data']);
        $lims_product_data = Product::where('code', $product_code[0])->first();

        $product[] = $lims_product_data->name;
        $product[] = $lims_product_data->code;
        $product[] = $lims_product_data->qty;
        $product[] = $lims_product_data->price;
        $product[] = $lims_product_data->id;
        return $product;
    }

    public function saleUnit($id)
    {
        $unit = Unit::where("base_unit", $id)->orWhere('id', $id)->pluck('unit_name', 'id');
        return json_encode($unit);
    }

    public function getData($id)
    {
        $data = Product::select('name', 'code')->where('id', $id)->get();
        return $data[0];
    }

    public function productWarehouseData($id)
    {
        $warehouse = [];
        $qty = [];
        $warehouse_name = [];
        $variant_name = [];
        $variant_qty = [];
        $product_warehouse = [];
        $product_variant_warehouse = [];
        $lims_product_data = Product::select('id', 'is_variant')->find($id);
        if ($lims_product_data->is_variant) {
            $lims_product_variant_warehouse_data = Product_Warehouse::where('product_id', $lims_product_data->id)->orderBy('warehouse_id')->get();
            $lims_product_warehouse_data = Product_Warehouse::select('warehouse_id', DB::raw('sum(qty) as qty'))->where('product_id', $id)->groupBy('warehouse_id')->get();
            foreach ($lims_product_variant_warehouse_data as $key => $product_variant_warehouse_data) {
                $lims_warehouse_data = Warehouse::find($product_variant_warehouse_data->warehouse_id);
                $lims_variant_data = Variant::find($product_variant_warehouse_data->variant_id);
                $warehouse_name[] = $lims_warehouse_data->name;
                $variant_name[] = $lims_variant_data->name;
                $variant_qty[] = $product_variant_warehouse_data->qty;
            }
        } else {
            $lims_product_warehouse_data = Product_Warehouse::where('product_id', $id)->get();
        }
        foreach ($lims_product_warehouse_data as $key => $product_warehouse_data) {
            $lims_warehouse_data = Warehouse::find($product_warehouse_data->warehouse_id);
            $warehouse[] = $lims_warehouse_data->name;
            $qty[] = $product_warehouse_data->qty;
        }

        $product_warehouse = [$warehouse, $qty];
        $product_variant_warehouse = [$warehouse_name, $variant_name, $variant_qty];
        return ['product_warehouse' => $product_warehouse, 'product_variant_warehouse' => $product_variant_warehouse];
    }

    public function printBarcode()
    {
        $lims_product_list_without_variant = $this->productWithoutVariant();
        $lims_product_list_with_variant = $this->productWithVariant();
        return view('product.print_barcode', compact('lims_product_list_without_variant', 'lims_product_list_with_variant'));
    }

    public function productWithoutVariant()
    {
        return Product::ActiveStandard()->select('id', 'name', 'code')
            ->whereNull('is_variant')->get();
    }

    public function productWithVariant()
    {
        return Product::join('product_variants', 'products.id', 'product_variants.product_id')
            ->ActiveStandard()
            ->whereNotNull('is_variant')
            ->select('products.id', 'products.name', 'product_variants.item_code')
            ->orderBy('position')->get();
    }

    public function limsProductSearch(Request $request)
    {
        $product_code = explode("(", $request['data']);
        $product_code[0] = rtrim($product_code[0], " ");

        $lims_product_data = Product::where('code', $product_code[0])->first();
        if (!$lims_product_data) {
            $lims_product_data = Product::join('product_variants', 'products.id', 'product_variants.product_id')
                ->select('products.*', 'product_variants.item_code')
                ->where('product_variants.item_code', $product_code[0])
                ->first();
        }
        $product[] = $lims_product_data->name;
        if ($lims_product_data->is_variant)
            $product[] = $lims_product_data->item_code;
        else
            $product[] = $lims_product_data->code;
        $product[] = $lims_product_data->price;
        $product[] = DNS1D::getBarcodePNG($lims_product_data->code, $lims_product_data->barcode_symbology);
        $product[] = $lims_product_data->promotion_price;
        $product[] = config('currency');
        $product[] = config('currency_position');
        return $product;
    }

    /*public function getBarcode()
    {
        return DNS1D::getBarcodePNG('72782608', 'C128');
    }*/

    public function importProduct(Request $request)
    {
        //get file
        $upload = $request->file('file');
        $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
        if ($ext != 'csv')
            return redirect()->back()->with('message', 'Please upload a CSV file');

        $filePath = $upload->getRealPath();
        //open and read
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);
        $escapedHeader = [];
        //validate
        foreach ($header as $key => $value) {
            $lheader = strtolower($value);
            $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        //looping through other columns
        while ($columns = fgetcsv($file)) {
            foreach ($columns as $key => $value) {
                $value = preg_replace('/\D/', '', $value);
            }
            $data = array_combine($escapedHeader, $columns);

            //    return abort('403', __('You are not authorized'));
            if (isset($data['brand'])) {
                if ($data['brand'] != 'N/A' && $data['brand'] != '') {
                    $lims_brand_data = Brand::firstOrCreate(['title' => $data['brand'], 'is_active' => true]);
                    $brand_id = $lims_brand_data->id;
                } else
                    $brand_id = null;
            } else {
                return abort('403', __('Format brand tidak sesuai. Silahkan gunakan format yang sesuai dengan mendownload contoh format file di halaman yang tersedia.'));
            }


            $lims_category_data = Category::firstOrCreate(['name' => $data['category'], 'is_active' => true]);

            $lims_unit_data = Unit::where('unit_code', $data['unitcode'])->first();
            if (!$lims_unit_data)
                return redirect()->back()->with('not_permitted', 'Unit code does not exist in the database.');

            $product = Product::firstOrNew(['name' => $data['name'], 'is_active' => true]);
            if ($data['image']) {
                $product->image = $data['image'];
                error_log("riki aldi pari ");
                error_log($product->image);
            } else {
                $product->image = 'zummXD2dvAtI.png';
            }

            $product->name = $data['name'];
            $product->code = $data['code'];
            $product->type = strtolower($data['type']);
            $product->barcode_symbology = 'C128';
            $product->brand_id = $brand_id;
            $product->category_id = $lims_category_data->id;
            $product->unit_id = $lims_unit_data->id;
            $product->purchase_unit_id = $lims_unit_data->id;
            $product->sale_unit_id = $lims_unit_data->id;
            $product->cost = $data['cost'];
            $product->price = $data['price'];
            $product->tax_method = 1;
            $product->qty = 0;
            $product->product_details = $data['productdetails'];
            $product->is_active = true;
            $product->save();

            if ($data['variantname']) {
                //dealing with variants
                $variant_names = explode(",", $data['variantname']);
                $item_codes = explode(",", $data['itemcode']);
                $additional_prices = explode(",", $data['additionalprice']);
                foreach ($variant_names as $key => $variant_name) {
                    $variant = Variant::firstOrCreate(['name' => $variant_name]);
                    if ($data['itemcode'])
                        $item_code = $item_codes[$key];
                    else
                        $item_code = $variant_name . '-' . $data['code'];

                    if ($data['additionalprice'])
                        $additional_price = $additional_prices[$key];
                    else
                        $additional_price = 0;

                    ProductVariant::create([
                        'product_id' => $product->id,
                        'variant_id' => $variant->id,
                        'position' => $key + 1,
                        'item_code' => $item_code,
                        'additional_price' => $additional_price,
                        'qty' => 0
                    ]);
                }
                $product->is_variant = true;
                $product->save();
            }
        }
        return redirect('products')->with('import_message', 'Product imported successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $product_id = $request['productIdArray'];
        foreach ($product_id as $id) {
            $lims_product_data = Product::findOrFail($id);
            $lims_product_data->is_active = false;
            $lims_product_data->save();
        }
        return 'Product deleted successfully!';
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Product::destroy($id);

            DB::commit();

            return response("Data Berhasil dihapus", 200);
        } catch (\Exception $ex) {

            DB::rollBack();

            return response("gagal: " . $ex->getMessage(), 500);
        }
    }

    public function productDataTable()
    {
        $this->authorize('viewAny', Product::class);

        $productQuery = Product::query()
            ->select('id', 'code', 'price', 'image', 'name', 'discount', 'created_at', 'tag_type_id', 'gramasi_id', 'product_property_id', 'mg')
            ->orderBy("created_at", "desc")
            ->with([ 'tagType:id,code,color', 'productProperty:id,code,description', 'gramasi:id,code,gramasi' ]);

        return DataTables::of($productQuery)
            ->editColumn('created_at', fn ($query) => date('d M Y', strtotime($query->created_at)))
            ->editColumn('price', fn ($query) => number_format($query->price, 2))
            ->addColumn('product_property_description', fn ($query) => $query->productProperty->description ?? "-")
            ->addColumn('product_property_code', fn ($query) => $query->productProperty->code ?? "-")
            ->addColumn('gramasi_gramasi', fn ($query) => $query->gramasi->gramasi ?? "-")
            ->addColumn('tag_type_code', fn ($query) => $query->tagType->code ?? "-")
            ->addColumn('gramasi_code', fn ($query) => $query->gramasi->code ?? "-")
            ->addColumn('tag_type_color', function ($query) {
                $color = $query->tagType->color ?? "none";
                return '<div class="h-100 w-100" style="background-color: ' . $color . '">' . $color . '</div>';
            })
            ->addColumn('action', function ($query) {
                $element =
                '<div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item btn-view" href="#"><i class="fa fa-eye"></i> View</a>
                        <a class="dropdown-item" href="' . url("products/$query->id/edit") . '"><i class="fa fa-pencil"></i> Edit</a>
                        <a class="dropdown-item btn-delete" href="#"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';

                return $element;
            })
            ->rawColumns(['tag_type_color', 'action'])
            ->make();
    }
}
