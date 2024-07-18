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
                WarehouseTransfer::create($data); // Membuat entri baru untuk setiap data
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
    public function edit(WarehouseTransfer $warehouseTransfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WarehouseTransfer  $warehouseTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WarehouseTransfer $warehouseTransfer)
    {
        //
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
}
