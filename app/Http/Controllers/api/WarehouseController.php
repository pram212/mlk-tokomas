<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Warehouse;

class WarehouseController extends Controller
{
    public function index()
    {
        try {
            $warehouses = Warehouse::all();
            return response()->json(['status' => 'success', 'data' => $warehouses, 'message' => ''], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'data' => [], 'message' => $e->getMessage()], 500);
        }
    }
}
