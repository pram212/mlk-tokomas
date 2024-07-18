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

        $query = WarehouseTransfer::select([
            'warehouse_transfers.id',
            'warehouse_transfers.product_id',
            'warehouse_transfers.split_set_code',
            'warehouse_transfers.created_at',
        ])
            ->with(['product', 'productSplitSetDetail', 'warehouse']);

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('code', function ($query) {
                return $query->split_set_code ?? $query->code;
            })
            ->make();
    }
}
