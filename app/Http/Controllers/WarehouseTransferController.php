<?php

namespace App\Http\Controllers;

use App\WarehouseTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreWarehouseTransferRequest;

class WarehouseTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warehouse_transfer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse_transfer.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseTransferRequest $request)
    {
        // Validasi sudah dilakukan oleh StoreWarehouseTransferRequest
        $dataToInsert = $request->only('data')['data'];

        try {
            DB::beginTransaction();

            foreach ($dataToInsert as $data) {
                $checkIfExist = DB::table('warehouse_transfers')->where('product_id', '=', $data['product_id'])->get();

                if($checkIfExist->isNotEmpty()) {
                    DB::table('warehouse_transfers')->where('product_id', '=', $data['product_id'])->update([
                        'status_warehouse' => 3
                    ]);
                } else {
                    WarehouseTransfer::create($data); // Membuat entri baru untuk setiap data
                    DB::table('warehouse_transfers')->where('product_id', '=', $data['product_id'])->update([
                        'status_warehouse' => 3
                    ]);
                }
                DB::table('products')->where('id', '=', $dataToInsert[0]['product_id'])->update([
                    'product_status' => 2
                ]);
            }
            DB::commit();

            // Redirect dengan pesan sukses
            return redirect()->route('warehouse_transfer.index')->with('message', 'Warehouse transfers created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // Handle error jika terjadi kegagalan saat menyimpan
            return back()->withInput()->with('message', 'Failed to create warehouse transfers: ' . $e->getMessage());
        }
    }

    function transferToEtalase(Request $request)  {
        try {
            DB::beginTransaction();
            DB::table('warehouse_transfers')->where('id', '=', $request->warehouse_transfer_id)->update([
                'status_warehouse' => 2
            ]);

            DB::table('products')->where('id', '=', $request->product_id)->update([
                'product_status' => 1
            ]);

            DB::commit();
            return redirect()->route('warehouse_transfer.index')->with($this->createAlert('success', 'Warehouse transfers to etalase successfully'));
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e);
            // Handle error jika terjadi kegagalan saat menyimpan
            return back()->withInput()->with('message', 'Failed to transfer warehouse to etalase: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WarehouseTransfer  $warehouseTransfer
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseTransfer $warehouseTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WarehouseTransfer  $warehouseTransfer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vals_warehouse_data = DB::table('warehouse_transfers')->where('warehouse_transfers.id', '=', $id)->leftJoin('products', 'warehouse_transfers.product_id', 'products.id')->first();

        return response()->json($vals_warehouse_data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            DB::table('products')->where('id', '=', $input['product_id'])->update([
                'code' => $input['code']
            ]);
            DB::commit();
            return redirect()->route('warehouse_transfer.index')->with($this->createAlert('success', 'Data Barcode updated successfully'));
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e);
            // Handle error jika terjadi kegagalan saat menyimpan
            return back()->withInput()->with('message', 'Failed to transfer warehouse to etalase: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WarehouseTransfer  $warehouseTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseTransfer $warehouseTransfer)
    {
        //
    }

    private function createAlert($type, $message)
    {
        return [
            'type' => "alert-{$type}",
            'message' => $message
        ];
    }
}
