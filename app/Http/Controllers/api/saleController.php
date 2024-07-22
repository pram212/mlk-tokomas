<?php

namespace App\Http\Controllers\api;

use App\Tax;
use App\Sale;
use App\Promo;
use App\Coupon;
use App\Payment;
use App\Product;
use App\Product_Sale;
use App\PaymentDetails;
use App\Product_Warehouse;
use Illuminate\Http\Request;
use App\ProductSplitSetDetail;
use App\Helpers\PermissionHelpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreSalePosRequest;

class saleController extends Controller
{
    // Get sale data for datatable
    public function index(Request $request)
    {
        $model = Sale::query()
            ->when($request->filled('warehouse_id'), function ($query) use ($request) {
                return $query->where('warehouse_id', $request->input('warehouse_id'));
            })
            ->when($request->filled('start_date'), function ($query) use ($request) {
                return $query->where('sales.created_at', '>=', $request->input('start_date') . ' 12:00:00');
            })
            ->when($request->filled('end_date'), function ($query) use ($request) {
                $endingDate = \Carbon\Carbon::parse($request->input('end_date'))->addDay()->format('Y-m-d') . ' 12:00:00';
                return $query->where('sales.created_at', '<=', $endingDate);
            })
            ->with('biller', 'customer', 'warehouse', 'user');

        // Melihat query yang dihasilkan
        // $sql = $model->toSql();
        // $bindings = $model->getBindings();

        // dd($sql, $bindings);



        // get permissions
        $permissions = PermissionHelpers::checkMenuPermission(['sales-edit', 'sales-delete']);

        // setup datatable data
        $datatable = DataTables::of($model)
            ->addIndexColumn()
            // ->editColumn('created_at', function ($sale) {
            //     return date(config('date_format'), strtotime($sale->created_at->toDateString()));
            // })
            ->editColumn('grand_total', function ($sale) {
                return number_format($sale->grand_total, 2);
            })
            ->addColumn('options', function ($sale) use ($permissions) {
                $actions = [
                    [
                        'route' => route('sales.invoice', $sale->id),
                        'icon' => 'fa-copy',
                        'label' => trans('file.Generate Invoice'),
                        'permission' => true
                    ],
                    // [
                    //     'button' => true,
                    //     'icon' => 'fa-eye',
                    //     'label' => trans('file.View'),
                    //     'data' => ['id' => $sale->id],
                    //     'class' => 'view',
                    //     'permission' => true
                    // ],
                    // [
                    //     'route' => $sale->sale_status != 3 ? route('sales.edit', $sale->id) : url('sales/' . $sale->id . '/create'),
                    //     'icon' => 'dripicons-document-edit',
                    //     'label' => trans('file.edit'),
                    //     'permission' => in_array("sales-edit", $permissions)
                    // ],
                    // [
                    //     'button' => true,
                    //     'icon' => 'fa-plus',
                    //     'label' => trans('file.Add Payment'),
                    //     'class' => 'add-payment',
                    //     'data' => ['id' => $sale->id],
                    //     'permission' => true
                    // ],
                    // [
                    //     'button' => true,
                    //     'icon' => 'fa-money',
                    //     'label' => trans('file.View Payment'),
                    //     'class' => 'get-payment',
                    //     'data' => ['id' => $sale->id],
                    //     'permission' => true
                    // ],
                    // [
                    //     'button' => true,
                    //     'icon' => 'fa-truck',
                    //     'label' => trans('file.Add Delivery'),
                    //     'class' => 'add-delivery',
                    //     'data' => ['id' => $sale->id],
                    //     'permission' => true
                    // ]
                ];

                return $this->generateActionOptions($actions);
            })
            ->rawColumns(['options'])
            ->make();

        return $datatable;
    }

    private function generateActionOptions($actions)
    {
        $options = '<div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . trans("file.action") . '
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">';

        foreach ($actions as $action) {
            if ($action['permission']) {
                if (isset($action['route'])) {
                    $options .= '<li><a href="' . $action['route'] . '" target="_BLANK" class="btn btn-link"><i class="fa ' . $action['icon'] . '"></i> ' . $action['label'] . '</a></li>';
                } elseif (isset($action['button'])) {
                    $dataAttributes = '';
                    if (isset($action['data'])) {
                        foreach ($action['data'] as $key => $value) {
                            $dataAttributes .= ' data-' . $key . '="' . $value . '"';
                        }
                    }
                    $options .= '<li>
                                    <button type="button" class="btn btn-link ' . $action['class'] . '"' . $dataAttributes . '><i class="fa ' . $action['icon'] . '"></i> ' . $action['label'] . '</button>
                                </li>';
                } elseif (isset($action['form'])) {
                    $options .= \Form::open(["route" => $action['route'], "method" => "DELETE"]) . '
                                <li>
                                  <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa ' . $action['icon'] . '"></i> ' . $action['label'] . '</button>
                                </li>' . \Form::close();
                }
            }
        }

        $options .= '</ul></div>';
        return $options;
    }

    public function pos_store(StoreSalePosRequest $request)
    {
        $requestData = $request->all();

        $user_id = auth()->user()->id;

        try {
            $items = $request['items'];
            $product_sales_data = $this->prepare_product_sale_data($items);
            $this->validate_product_status($items, $requestData['warehouse_id'], 1);
            $total_price = ceil(array_sum(array_column($product_sales_data, 'total')));
            $tax_data = $this->prepare_tax_data($request['tax'], $total_price);
            $discount_data = $this->prepare_discount_data($total_price, $request['discount']);
            $coupon_data = $this->prepare_coupon_data($total_price, $request['coupon_code']);


            DB::beginTransaction();

            $sale = new Sale();
            $sale->fill([
                'reference_no' => $this->generateReferenceNo($user_id, $requestData['customer_id'], $requestData['warehouse_id']),
                'user_id' => $user_id,
                'cash_register_id' => null,
                'customer_id' => $requestData['customer_id'],
                'warehouse_id' => $requestData['warehouse_id'],
                'cashier_id' => $requestData['cashier_id'],
                'item' => count($items),
                'total_qty' => array_sum(array_column($items, 'qty')),
                'total_discount' => $discount_data['discount_amount'] + $coupon_data['coupon_discount'],
                'total_tax' => $tax_data['tax_amount'],
                'total_price' => $total_price,
                'grand_total' => ceil($total_price + $tax_data['tax_amount'] - $discount_data['discount_amount'] - $coupon_data['coupon_discount']),
                'order_tax_rate' => $tax_data['tax_amount'],
                'order_tax' => 0,
                'order_discount' => $discount_data['discount_amount'],
                'coupon_id' => $coupon_data['coupon_id'],
                'coupon_discount' => $coupon_data['coupon_discount'],
                'shipping_cost' => 0,
                'sale_status' => 0,
                'payment_status' => 4,
                'paid_amount' => $requestData['paid_amount'] ?? 0,
                'sale_note' => $requestData['payment_sale_note'] ?? null,
                'staff_note' => $requestData['payment_staff_note'] ?? null,
            ]);

            $sale->save();

            /* Save product sales */
            $sale->productSales()->createMany($product_sales_data);

            /* Save Payments */
            $payment_data = $requestData['payment_methods'];
            // $payment_total_amount = array_sum(array_column($payment_data, 'amount'));
            $payment_total_amount = $requestData['paid_amount'] ?? 0;
            $payment = $sale->payments()->create([
                'payment_reference' => $this->generatePaymentReference($user_id, $requestData['customer_id'], $requestData['warehouse_id']),
                'user_id' => $user_id,
                'account_id' => 1,
                'amount' => $payment_total_amount,
                'payment_note' => $requestData['payment_sale_note'],
                'change' => $payment_total_amount - $sale->grand_total,
            ]);

            // $payment->paymentDetails()->createMany($payment_data);
            $payment->paymentDetails()->create([
                'payment_method_id' => $payment_data,
                'bank_id' => null,
                'card_number' => null,
                'amount' => $payment_total_amount,
            ]);


            DB::commit();

            return response()->json([
                'isSuccess' => true,
                'message' => 'Sale created successfully',
                'data' => $sale
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'isSuccess' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    private function generateReferenceNo($user_id, $customer_id, $warehouse_id)
    {
        /* Generate a unique reference number */
        /* Format: POS - User ID Customer ID Warehouse ID - current timestamp */
        $timestamp = time();

        /* check if generated reference number already exists */
        $reference_no = 'POS-' . $user_id  . $customer_id . $warehouse_id . '-' . $timestamp;
        $sale = Sale::where('reference_no', $reference_no)->first();
        if ($sale) {
            return $this->generateReferenceNo($user_id, $customer_id, $warehouse_id);
        }

        return $reference_no;
    }

    private function generatePaymentReference($user_id, $customer_id, $warehouse_id)
    {
        /* Generate a unique reference number */
        /* Format: PYM - User ID Customer ID Warehouse ID - current timestamp */
        $timestamp = time();

        /* check if generated reference number already exists */
        $reference_no = 'PYM-' . $user_id  . $customer_id . $warehouse_id . '-' . $timestamp;
        $data = Payment::where('payment_reference', $reference_no)->first();
        if ($data) {
            return $this->generatePaymentReference($user_id, $customer_id, $warehouse_id);
        }

        return $reference_no;
    }

    private function prepare_product_sale_data($items)
    {
        /* NOTE : product_id means product code */

        /* Prepare product sale data for mapping product_id, qty, net_unit_price, and total */
        $product_sale_data = [];

        foreach ($items as $item) {
            // Validasi input
            if (!isset($item['product_id']) || !isset($item['qty'])) throw new \Exception("Item harus memiliki 'product_id' dan 'qty'.");


            $product = Product::where('code', $item['product_id'])->with('productWarehouse', 'gramasi')->first();
            $product_split = null;
            $discount = 0;

            if (!$product) {
                $product_split = ProductSplitSetDetail::where('split_set_code', $item['product_id'])->first();
                if (!$product_split) throw new \Exception("Product dengan kode {$item['product_id']} tidak ditemukan.");
            }

            $product_id = $product->id ?? $product_split->product_id; // Real product id
            $product = Product::where('id', $product_id)->with('productWarehouse', 'gramasi')->first();

            $net_unit_price =  (float)@$product_split->price ??  (float)@$product->product_warehouse->price ?? 0;
            $qty = $item['qty'];
            $total = $net_unit_price * $qty;
            $gramasi = $product_split->gramasi ?? $product->gramasi->gramasi ?? 0;

            $product_sale_data[] = [
                'product_id' => $product_id,
                'split_set_code' => $product_split->split_set_code ?? null,
                'variant_id' => null,
                'qty' => $qty,
                'sale_unit_id' => $product->sale_unit_id ?? null,
                'net_unit_price' => $net_unit_price,
                'discount' => ($product->discount * 1000 * $gramasi) ?? 0,
                'sale_unit_id' => 0,
                'tax_rate' => 0,
                'tax' => 0,
                'total' => $total,
            ];
        }

        return $product_sale_data;
    }

    private function prepare_tax_data($tax_id, $total_price)
    {
        /* Prepare tax data for mapping tax_id, tax_rate, and tax_amount */
        if ($tax_id !== 0) {
            $tax = Tax::where(['id' => $tax_id, 'is_active' => 1])->first();

            if (!$tax) {
                throw new \Exception('Invalid tax id');
            }

            return [
                'tax_id' => $tax->id,
                'tax_rate' => $tax->rate,
                'tax_amount' => ceil($tax->rate / 100 * $total_price)
            ];
        } else {
            return [
                'tax_id' => null,
                'tax_rate' => 0,
                'tax_amount' => 0
            ];
        }
    }

    private function prepare_discount_data($total_price, $discount_percent = 0)
    {
        /* Prepare discount data for mapping discount_percent and discount_amount */
        return [
            'discount_percent' => $discount_percent,
            'discount_amount' => ceil($discount_percent / 100 * $total_price)
        ];
    }

    private function prepare_coupon_data($total_price, $coupon_code = null)
    {
        /* Prepare coupon data for mapping coupon_id and coupon_discount */
        if ($coupon_code !== "" && $coupon_code !== null) {
            $coupon = Coupon::where('code', $coupon_code)->where('is_active', 1)->first();

            if (!$coupon) {
                throw new \Exception('Invalid coupon code');
            }

            if ($coupon->minimum_amount > $total_price) {
                throw new \Exception('Minimum amount not reached');
            }

            if ($coupon->quantity < $coupon->used) {
                throw new \Exception('Coupon limit reached');
            }

            return [
                'coupon_id' => $coupon->id,
                'coupon_type' => $coupon->type,
                'minimum_amount' => $coupon->minimum_amount,
                'coupon_amount' => $coupon->amount,
                'coupon_discount' => $coupon->type == 'fixed' ? $coupon->amount : ceil($total_price * $coupon->amount / 100)
            ];
        } else {
            return [
                'coupon_id' => null,
                'coupon_discount' => 0
            ];
        }
    }

    private function validate_product_qty($items, $warehouse_id)
    {
        /* Validate product quantity */
        foreach ($items as $item) {
            $isSplitProduct = strpos($item['product_id'], '-') !== false;
            $qty = $item['qty'];

            if ($isSplitProduct) {
                $productSplit = ProductSplitSetDetail::where('split_set_code', $item['product_id'])->first();

                if (!$productSplit) {
                    throw new \Exception("Product with code {$item['product_id']} not found");
                }

                if ($productSplit->qty_product < $item['qty']) {
                    throw new \Exception("Product {$productSplit->product->name} is out of stock");
                }
            } else {
                $product = Product::where('code', $item['product_id'])->first();

                if (!$product) {
                    throw new \Exception("Product with code {$item['product_id']} not found");
                }

                $productWarehouse = Product_Warehouse::where('product_id', $product->id)
                    ->where('warehouse_id', $warehouse_id)
                    ->first();

                if (!$productWarehouse) {
                    throw new \Exception("Product {$product->name} is out of stock");
                }

                if ($productWarehouse->qty < $qty) {
                    throw new \Exception("Product {$product->name} is out of stock");
                }
            }
        }
    }

    private function validate_product_status($items, $warehouse_id, $status = 1)
    {
        /* Validate product quantity */
        foreach ($items as $item) {
            $isSplitProduct = strpos($item['product_id'], '-') !== false;
            $qty = $item['qty'];

            if ($isSplitProduct) {
                $productSplit = ProductSplitSetDetail::where('split_set_code', $item['product_id'])->first();

                if (!$productSplit) {
                    throw new \Exception("Product with code {$item['product_id']} not found");
                }

                if ($productSplit->product_status != $status) {
                    throw new \Exception("Product {$productSplit->product->name} is not available");
                }
            } else {
                $product = Product::where('code', $item['product_id'])->first();

                if (!$product) {
                    throw new \Exception("Product with code {$item['product_id']} not found");
                }

                if ($product->product_status != $status) {
                    throw new \Exception("Product {$product->name} is not available");
                }
            }
        }
    }
}
