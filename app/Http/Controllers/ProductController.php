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
use App\ProductBuyback;
use App\Warehouse;
use App\Category;
use App\Product;
use App\Variant;
use App\Gramasi;
use App\TagType;
use App\Brand;
use App\Unit;
use App\Product_Sale;
use Milon\Barcode\DNS1D;
use Keygen;
use Dompdf\Dompdf;
use View;
use QrCode;
use App\Helpers\ResponseHelpers;
use App\Potongan;
use App\WarehouseTransfer;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);

        return view('product.index');
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        $category = Category::where('is_active', true)->get();
        $productProperty = ProductProperty::all();
        $product_type = ProductType::all();
        $tagType = TagType::all();
        $gramasi = Gramasi::all();
        $discount = Potongan::all();
        $mode = 'create';
        $warehouses = Warehouse::where('is_active', true)->get();
        $split_set_type = [
            [
                'id' => 1,
                'name' => 'Full Set'
            ], [
                'id' => 2,
                'name' => 'Split Set'
            ]
        ];

        return view('product.form', compact(
            'productProperty',
            'product_type',
            'tagType',
            'gramasi',
            'category',
            'discount',
            'mode',
            'split_set_type',
            'warehouses'
        ));
    }

    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', Product::class);
        $dataToInsert = $request->all();

        try {
            DB::beginTransaction();
            $imagePath = $this->handleImageUpload($request);
            $request->merge(['image' => $imagePath, 'is_active' => 1]);

            $product = Product::create($request->request->all());
            $product->productWarehouse()->create([
                "warehouse_id" => $request->warehouse_id,
                "qty" => 1, // FIX QTY
                "price" => $request->price,
            ]);

            WarehouseTransfer::create([
                'transfer_number' => $this->gen_transfer_number(),
                'product_id' => $product->id,
                'warehouse_id' => $dataToInsert['warehouse_id'],
            ]); // Membuat entri baru untuk setiap data

            if ($request->split_set_type == 2) $this->handleStoreSplitSetType($product, $request);

            DB::commit();

            return redirect()->route('products.index')->with($this->createAlert('success', 'Product created successfully'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return back()->with($this->createAlert('danger', $ex->getMessage()));
        }
    }

    private function gen_transfer_number()
    {
        $tf_number = 'TF' . date('Ymd') . rand(1000, 9999);
        $tf_number_exists = WarehouseTransfer::where('transfer_number', $tf_number)->exists();

        if ($tf_number_exists) {
            return $this->gen_transfer_number();
        }

        return $tf_number;
    }

    private function handleImageUpload($request)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            return "storage/app/" . $file->storeAs('product_images', time() . date('YmdHms') . "." . $file->extension());
        }

        return $request->image ?: 'zummXD2dvAtI.png';
    }

    private function handleStoreSplitSetType($product, $request)
    {
        $splitSetDetails = $this->prepareSplitSetDetails($product->id, $request);

        $product->productSplitSetDetail()->createMany($splitSetDetails);
        $product->productDetailSplitHistory()->createMany($splitSetDetails);
    }

    private function prepareSplitSetDetails($productId, $request)
    {
        $splitSetDetails = [];
        foreach ($request->split_set_code as $index => $code) {
            $splitSetDetails[] = [
                'product_id' => $productId,
                'split_set_code' => $code,
                'qty_product' => $request->split_set_qty[$index],
                'price' => $request->split_set_harga[$index],
                'gramasi' => $request->split_set_gramasi[$index],
                'mg' => $request->split_set_mg[$index],
            ];
        }
        return $splitSetDetails;
    }

    private function createAlert($type, $message)
    {
        return [
            'type' => "alert-{$type}",
            'message' => $message
        ];
    }

    public function show($id, Request $request)
    {
        $product = Product::find($id)->load([
            'productProperty:id,code,description',
            'gramasi:id,code,gramasi',
            'tagType:id,code,color',
            'category',
            'product_warehouse',
        ]);

        $this->authorize('update', $product);

        $split_set_code = $request->split_set_code ?? null;

        $category = Category::where('is_active', true)->get();
        $productProperty = ProductProperty::all();
        $productType = ProductType::all();
        $tagType = TagType::all();
        $gramasi = Gramasi::all();
        $product_type = ProductType::where('categories_id', $product->category_id)->get();
        $warehouses = Warehouse::where('id', $product->product_warehouse->warehouse_id)->get();
        $split_set_type = [
            [
                'id' => 1,
                'name' => 'Full Set'
            ], [
                'id' => 2,
                'name' => 'Split Set'
            ]
        ];

        $product = Product::find($id)->load([
            'productProperty:id,code,description',
            'gramasi:id,code,gramasi',
            'tagType:id,code,color',
            'category',
            'productSplitSetDetail',
            'product_warehouse'
        ]);

        $mode = 'show';

        return view('product.form', compact(
            'productProperty',
            'productType',
            'tagType',
            'gramasi',
            'product',
            'category',
            'product_type',
            'mode',
            'warehouses',
            'split_set_type',
            'split_set_code'
        ));
    }

    public function getDetailById($id)
    {
        $product = Product::find($id)->load([
            'productProperty:id,code,description',
            'productWarehouse',
            'gramasi:id,code,gramasi',
            'tagType:id,code,color',
            'category'
        ]);

        $product['discount_value'] = DB::table('potongan')->where('id','=', $product->discount)->first();
        return response()->json($product);
    }

    public function edit($id, Request $request)
    {
        $product = Product::find($id)->load([
            'productProperty:id,code,description',
            'gramasi:id,code,gramasi',
            'tagType:id,code,color',
            'category'
        ]);

        $this->authorize('update', $product);

        $category = Category::where('is_active', true)->get();
        $productProperty = ProductProperty::all();
        $productType = ProductType::all();
        $tagType = TagType::all();
        $gramasi = Gramasi::all();
        $warehouses = Warehouse::where('is_active', true)->get();
        $product_type = ProductType::where('categories_id', $product->category_id)->get();
        $split_set_type = [
            [
                'id' => 1,
                'name' => 'Full Set'
            ], [
                'id' => 2,
                'name' => 'Split Set'
            ]
        ];

        $product = Product::find($id)->load([
            'productProperty:id,code,description',
            'gramasi:id,code,gramasi',
            'tagType:id,code,color',
            'category',
            'productSplitSetDetail'
        ]);

        $mode = 'edit';
        $split_set_id = $request->split_set_id ?? null;

        return view('product.form', compact(
            'productProperty',
            'productType',
            'tagType',
            'gramasi',
            'product',
            'category',
            'product_type',
            'mode',
            'split_set_type',
            'split_set_id',
            'warehouses'
        ));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);

        $this->authorize('update', $product);

        try {

            DB::beginTransaction();

            $imagePath = 'zummXD2dvAtI.png';


            if ($request->file('image')) {
                $file = $request->file('image');
                $imagePath = "storage/app/" . $file->storeAs('product_images', time() . date('YmdHms') . "." . $file->extension());

                // Jika ada file gambar yang diunggah, hapus file gambar lama
                if ($product->image) unlink($product->image);

                $request->merge(['image' => $imagePath]);

                $product->image = $imagePath;
                $product->update([
                    'image' => $imagePath
                ]);
            }

            $product->update([
                'tag_type_id' => $request->tag_type_id,
                'code' => $request->code,
                'gold_content' => $request->gold_content,
                'additional_code' => $request->additional_code,
                'category_id' => $request->category_id,
                'product_type_id' => $request->product_type_id,
                'discount' => $request->discount,
                'gramasi_id' => $request->gramasi_id,
                'mg' => $request->mg,
                'product_property_id' => $request->product_property_id,
                'name' => $request->name,
                'split_set_type' => $request->split_set_type,
            ]);

            $product->productWarehouse()->update([
                "warehouse_id" => $request->warehouse_id,
                "qty" => 1, // FIX QTY
                "price" => $request->price,
            ]);

            // handle if split set type is split set (2)
            if ($request->split_set_type == 2) {
                $product = Product::find($id);
                $product->qty = $request->detail_split_set_qty;

                // get all product_split_set_detail by product_id
                $product_split_set_detail_old = $product->productSplitSetDetail;

                // delete all product_split_set_detail by product_id
                $product->productSplitSetDetail()->delete();

                // save product detail split set to product_split_set_detail split_set_code[] and split_set_qty[]
                $split_set_code = $request->split_set_code;
                $split_set_qty = $request->split_set_qty;
                $split_set_detail = [];
                foreach ($split_set_code as $index => $code) {
                    $detail = [
                        'product_id' => $id,
                        'split_set_code' => $code,
                        'qty_product' => $split_set_qty[$index]
                    ];

                    // Cek apakah terdapat detail produk lama dengan kode yang sama
                    $oldDetail = $product_split_set_detail_old->where('split_set_code', $code)->first();

                    // Simpan detail produk baru
                    $product->productSplitSetDetail()->create($detail);

                    // Jika detail produk lama ditemukan dan kuantitasnya berbeda, simpan ke history
                    if ($oldDetail && $oldDetail->qty_product != $split_set_qty[$index]) {
                        $product->productDetailSplitHistory()->create($detail);
                    }

                    // Jika detail produk lama tidak ditemukan, simpan ke history
                    if (!$oldDetail) {
                        $product->productDetailSplitHistory()->create($detail);
                    }
                }


                // save to product_split_set_detail
                $product->productSplitSetDetail()->createMany($split_set_detail);

                $product->save();
            }

            DB::commit();

            return back()->with([
                'type' => 'alert-success',
                'message' => 'Product updated successfully'
            ]);
        } catch (\Exception $ex) {

            DB::rollBack();

            return back()->with([
                'type' => 'alert-error',
                'message' => $ex->getMessage(),
            ]);
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
        try {
            $product_ids = $request->ids; // required
            $product_split_set_ids = $request->split_ids ?? []; // optional

            DB::beginTransaction();
            foreach ($product_ids as $index => $id) {
                $product = Product::find($id);

                if (!$product) {
                    continue;
                }

                if (count($product_split_set_ids) > 0 && isset($product_split_set_ids[$index])) {
                    $splitSetId = $product_split_set_ids[$index];
                    $productSplitSetDetail = $product->productSplitSetDetail()->find($splitSetId);

                    if (!$productSplitSetDetail) {
                        continue;
                    }

                    $productSale = Product_Sale::where('split_set_code', $productSplitSetDetail->split_set_code)->first();

                    if ($productSale) {
                        DB::rollBack();
                        return ResponseHelpers::formatResponse(__('file.Product cannot be deleted because it has been sold'), [], 500, false);
                    }

                    $productSplitSetDetail->delete();
                } else {
                    $productSale = Product_Sale::where('product_id', $id)->first();

                    if ($productSale) {
                        DB::rollBack();
                        return ResponseHelpers::formatResponse(__('file.Product cannot be deleted because it has been sold'), [], 500, false);
                    }

                    $product->delete();
                }
            }



            DB::commit();

            return ResponseHelpers::formatResponse(__('file.Data deleted successfully'), []);
        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseHelpers::formatResponse($e->getMessage(), [], 500, false);
        }
    }

    public function destroy($id, Request $request)
    {
        $this->authorize('delete', Product::find($id));

        try {
            DB::beginTransaction();

            // Get product by ID
            $product = Product::find($id);

            // If parameter ?split_id is not empty
            if ($request->filled('split_id')) {
                // Get product split set detail by split_id
                $productSplitSetDetail = $product->productSplitSetDetail()->findOrFail($request->split_id);

                // check if split_set_code if exist in Product_Sale
                $productSale = Product_Sale::where('split_set_code', $productSplitSetDetail->split_set_code)->first();

                if ($productSale) {
                    DB::rollBack();
                    // return response("Product tidak bisa dihapus karena sudah pernah terjual", 500);
                    return ResponseHelpers::formatResponse(__('file.Product cannot be deleted because it has been sold'), [], 500, false);
                }

                // Delete product split set detail
                $productSplitSetDetail->delete();
            } else {
                // check if product is exist in Product_Sale
                $productSale = Product_Sale::where('product_id', $product->id)->first();

                if ($productSale) {
                    DB::rollBack();
                    // return response("Product tidak bisa dihapus karena sudah pernah terjual", 500);
                    return ResponseHelpers::formatResponse(__('file.Product cannot be deleted because it has been sold'), [], 500, false);
                }
                // Delete product
                $product->delete();
            }

            DB::commit();

            // return response("Data Berhasil dihapus", 200);
            return ResponseHelpers::formatResponse(__('file.Data deleted successfully'), []);
        } catch (\Exception $ex) {

            DB::rollBack();

            return ResponseHelpers::formatResponse($ex->getMessage(), [], 500, false);
        }
    }

    public function productDataTable(Request $request)
    {
        $this->authorize('viewAny', Product::class);

        $productQuery = Product::query()
            ->select([
                'products.id',
                DB::raw("COALESCE(split.split_set_code, products.code) as code"),
                'split.split_set_code',
                'categories.name as category_name',
                'split.id as split_id',
                'product_warehouse.warehouse_id',
                DB::raw("COALESCE(buyback.final_price, COALESCE(split.price, product_warehouse.price)) as price"),
                'products.image',
                'products.name',
                'products.discount',
                DB::raw("COALESCE(split.created_at, products.created_at) as created_at"),
                'tag_type_id',
                'gramasi_id',
                DB::raw("products.product_property_id as product_property_id"),
                DB::raw("COALESCE(split.mg, products.mg) as mg"),
                DB::raw("COALESCE(split.product_status, products.product_status) as product_status"),
                DB::raw("COALESCE(split.invoice_number, products.invoice_number) as invoice_number")
            ])
            ->leftJoin('product_split_set_detail as split', 'products.id', '=', 'split.product_id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('product_warehouse as product_warehouse', 'products.id', '=', 'product_warehouse.product_id')
            ->leftJoin('product_buyback as buyback', function ($join) {
                $join->on('products.id', '=', 'buyback.product_id');
                $join->where(function ($query) {
                    $query->on('split.split_set_code', '=', 'buyback.code')
                        ->orWhereNull('split.split_set_code'); // Handle case when split_set_code is NULL
                });
            })
            ->where('products.is_active', true);

        if ($warehouseIds = $request->get('warehouse_ids')) {
            $productQuery->whereIn('product_warehouse.warehouse_id', explode(',', $warehouseIds));
        }
        if ($categoryId = $request->get('category_id')) {
            $productQuery->where('products.category_id', $categoryId);
        }

        if ($statusIds = $request->get('status_ids') !== null) {
            $statusIds = $request->get('status_ids');
            $productQuery->whereIn(DB::raw('COALESCE(split.product_status, products.product_status)'), explode(',', $statusIds));
        }
        // check jika menu product stock
        // maka query untuk by produk status hanya by status STORE
        $currenturl = url()->previous();
        $jikaMenuStock = str_contains($currenturl, 'product_stock');
        if($jikaMenuStock) {// (STOK PRODUCT)
            $productQuery->where(DB::raw('COALESCE(split.product_status, products.product_status)'), 1);
             // query untuk role sales dan cashier by warehouse id
            $warehouse_id = Auth::user()->warehouse_id; // get warehouse from user
            $role_id = Auth::user()->role_id;

            $getRole = DB::table('roles')->where('id', '=', $role_id)->first();
            $nameRole = $getRole->name;
            // jika role sales dan cashier maka filter by warehouse
            // jika management maka tampil semua by status STORE
            if($nameRole == 'Cashier' || $nameRole == 'Sales') {
                $productQuery->where('product_warehouse.warehouse_id', $warehouse_id);
            }
        }
        $datatable =  DataTables::of($productQuery)
            ->addIndexColumn()
            ->editColumn('created_at', fn ($product) => date('d M Y', strtotime($product->created_at)))
            ->editColumn('price', fn ($product) => $product->price)
            ->addColumn('product_property_description', fn ($product) => $product->productProperty->description ?? "-")
            ->addColumn('product_property_code', fn ($product) => $product->productProperty->code ?? "-")
            ->addColumn('gramasi_gramasi', fn ($product) => $product->gramasi->gramasi ?? "-")
            ->addColumn('tag_type_code', fn ($product) => $product->tagType->code ?? "-")
            ->addColumn('gramasi_code', fn ($product) => $product->gramasi->code ?? "-")
            ->addColumn('category_name', fn ($product) => $product->category_name ?? "-")
            ->addColumn('product_status', function ($product) {
                switch ($product->product_status) {
                    case 0:
                        return 'SOLD';
                    case 1:
                        return 'STORE';
                    case 2:
                        return 'Transfer to Gudang';
                    default:
                        return 'STORE';
                }
            })
            ->addColumn('invoice_number', function ($product) {
                return $product->invoice_number ?? "-";
            })
            ->addColumn('image_preview', function ($q) {
                return '<img src="' . asset($q->image) . '" class="img-thumbnail" width="100" height="100">';
            })
            ->addColumn('tag_type_color', function ($product) {
                $color = $product->tagType->color ?? "none";
                return '<div class="h-100 w-100" style="background-color: ' . $color . '">' . $color . '</div>';
            })
            ->addColumn('warehouse_name', function ($product) {
                return $product->product_warehouse->warehouse->name ?? "-";
            })
            ->addColumn('action', function ($product) {
                $user = auth()->user();
                return view('product.index_action', compact('product', 'user'));
            })
            ->rawColumns(['tag_type_color', 'action', 'image_preview', 'barcode'])
            ->make();

        return $datatable;
    }

    // Fungsi untuk mendapatkan barcode dan mengembalikannya sebagai tautan unduhan
    function getBarcodeDownloadLink($product)
    {
        $barcode = $this->getCustomBarcodePNG($product->code);
        $url = "data:image/png;base64,$barcode";
        $filename = "barcode_{$product->code}.png";

        return '<a href="' . $url . '" download="' . $filename . '">
                    <img src="' . $url . '" class="img-thumbnail p-2">
                </a>';
    }

    function getCustomBarcodePNG($code)
    {
        $dns1d = new DNS1D();
        // Set color: foreground = black, background = white
        $barcode = $dns1d->getBarcodePNG($code, 'C128', 1, 30, [0, 0, 0], true);
        return $barcode;
    }

    public function detailHistoricalProductDataTable($product_id, $split_set_code = "")
    {
        $this->authorize('viewAny', Product::class);
        $productSalesQuery = Product_Sale::query()
            ->select([
                DB::raw("COALESCE(product_sales.split_set_code, products.code) as code"),
                'total as price',
                'name',
                'product_sales.created_at',
                'gramasi_id',
                DB::raw("products.product_property_id as product_property_id"),
                DB::raw("COALESCE(split.mg, products.mg) as mg"),
                DB::raw("COALESCE(split.invoice_number, products.invoice_number) as invoice_number"),
                DB::raw("1 as history_status"), // 0 = Product Created, 1 = Product Sold, 2 = Product Buyback
            ])
            ->leftJoin('products', 'products.id', '=', 'product_sales.product_id')
            ->leftJoin('product_split_set_detail as split', 'product_sales.split_set_code', '=', 'split.split_set_code')
            ->where('is_active', true)
            ->when($split_set_code || $product_id, function ($query) use ($split_set_code, $product_id) {
                return $query->where(function ($query) use ($split_set_code, $product_id) {
                    if ($split_set_code != "") {
                        $query->where('split.split_set_code', $split_set_code);
                    } else {
                        $query->where('products.id', $product_id);
                    }
                });
            })
            ->groupBy(['product_sales.id'])
            ->orderByDesc('product_sales.created_at');

        $productQuery = Product::query()
            ->select([
                DB::raw("COALESCE(split.split_set_code, products.code) as code"),
                DB::raw("COALESCE(split.price, product_warehouse.price) as price"),
                'name',
                DB::raw("COALESCE(split.created_at, products.created_at) as created_at"),
                'gramasi_id',
                DB::raw("products.product_property_id as product_property_id"),
                DB::raw("COALESCE(split.mg, products.mg) as mg"),
                DB::raw("COALESCE(split.invoice_number, products.invoice_number) as invoice_number"),
                DB::raw("0 as history_status"), // 0 = Product Created, 1 = Product Sold, 2 = Product Buyback
            ])
            ->leftJoin('product_split_set_detail as split', 'products.id', '=', 'split.product_id')
            ->leftJoin('product_warehouse as product_warehouse', 'products.id', '=', 'product_warehouse.product_id')
            ->where('is_active', true)
            ->when($split_set_code || $product_id, function ($query) use ($split_set_code, $product_id) {
                return $query->where(function ($query) use ($split_set_code, $product_id) {
                    if ($split_set_code != "") {
                        $query->where('split.split_set_code', $split_set_code);
                    } else {
                        $query->where('products.id', $product_id);
                    }
                });
            })
            ->groupBy(['products.id', 'split.id'])
            ->orderByDesc('products.created_at', ' split.created_at');



        // join 3 query
        $productQuery->union($productSalesQuery);


        DB::statement("SET sql_mode = '' ");
        $datatable =  DataTables::of($productQuery)
            ->addIndexColumn()
            ->editColumn('created_at', fn ($product) => date('d M Y', strtotime($product->created_at)))
            ->editColumn('price', fn ($product) => $product->price)
            ->addColumn('product_property_description', fn ($product) => $product->productProperty->description ?? "-")
            ->addColumn('product_property_code', fn ($product) => $product->productProperty->code ?? "-")
            ->addColumn('gramasi_gramasi', fn ($product) => $product->gramasi->gramasi ?? "-")
            ->addColumn('tag_type_code', fn ($product) => $product->tagType->code ?? "-")
            ->addColumn('gramasi_code', fn ($product) => $product->gramasi->code ?? "-")
            ->addColumn('product_status', function ($product) {
                switch ($product->product_status) {
                    case 0:
                        return 'SOLD';
                    case 1:
                        return 'STORE';
                    case 2:
                        return 'Transfer to Gudang';
                    default:
                        return 'STORE';
                }
            })
            ->addColumn('history_status', function ($product) {
                // 0 = Product Created, 1 = Product Sold, 2 = Product Buyback
                $status = "";
                switch ($product->history_status) {
                    case 0:
                        $status = "Created";
                        break;
                    case 1:
                        $status = "Sold";
                        break;
                    case 2:
                        $status = "Buyback";
                        break;
                    default:
                        $status = "Created";
                        break;
                }
                return $status;
            })
            ->addColumn('invoice_number', function ($product) {
                return $product->invoice_number ?? "-";
            })
            ->make();

        return $datatable;
    }

    public function print(Request $request, $id)
    {
        $product = Product::find($id)->load([
            'productProperty:id,code,description',
            'gramasi:id,code,gramasi',
            'tagType:id,code,color',
            'category'
        ]);
        $product['discount_value'] = DB::table('potongan')->where('id','=', $product->discount)->first();

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $dompdf->setOptions($options);
        // $dompdf->setPaper('A4', 'portrait');
        $dompdf->setPaper(array(0, 0, 580, 250), 'portrait');

        $datetime = date('YmdHis');

        $filename = "product_$product->code.pdf";

        $path = public_path('temp_' . $product->code . '_' . date('YmdHis') . '.png');
        QrCode::size(150)->generate($product->code, $path);

        // Load view
        $html = View::make('product.print', ['data' => $product, 'path' => $path, 'filename' => $filename]);
        $html = $html->render();

        // Load HTML
        $dompdf->loadHtml($html);

        // remove qr code
        unlink($path);

        // Render the HTML as PDF
        $dompdf->render();

        // Open pdf in browser
        $dompdf->stream($filename, array("Attachment" => false));
    }

    public function getProductDetailSplitSetHistory($id)
    {
        $product = Product::find($id);
        $productDetailSplitHistory = $product->productDetailSplitHistory;

        return response()->json($productDetailSplitHistory);
    }

    public function viewProduct($product_code, $split_set_code = null)
    {
        // get product by code
        $product = Product::where('code', $product_code)->first();
        $productSplitSetDetail = null;

        // handle if product not found, redirect to 404
        if (!$product) {
            abort(404);
        }

        // if split set code is not null
        if ($split_set_code) {
            // get product_split_set_detail by split_set_code
            $productSplitSetDetail = $product->productSplitSetDetail()->where('split_set_code', $split_set_code)->first();

            // handle if product_split_set_detail not found, redirect to 404
            if (!$productSplitSetDetail) {
                abort(404);
            }
        }

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $dompdf->setOptions($options);
        $dompdf->setPaper('A4', 'potrait');

        $html = view('product.view_product', compact('product', 'productSplitSetDetail'))->render();

        $dompdf->loadHtml($html);

        $dompdf->render();

        $filename = 'xxx.pdf';

        // Open pdf in browser
        $dompdf->stream($filename, array("Attachment" => false));
    }
}
