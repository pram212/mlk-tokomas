<?php

namespace App\Http\Controllers\api;

use App\Product;
use App\WarehouseTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class warehouseTransferController extends Controller
{
    function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);

        $query = WarehouseTransfer::with(['product', 'productSplitSetDetail', 'warehouse']);

        return DataTables::of($query)
            ->make();
    }
}
