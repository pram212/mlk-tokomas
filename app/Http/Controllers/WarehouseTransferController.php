<?php

namespace App\Http\Controllers;

use App\WarehouseTransfer;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
