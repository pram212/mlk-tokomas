<?php

namespace App\Http\Controllers\api;

use App\Adjustment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class AdjustmentContoller extends Controller
{
    public function index()
    {
        $query = Adjustment::query()
            ->select('adjustments.*')
            ->with(['adjustmentItems', 'warehouse']);
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('warehouse', fn ($adjustment) => $adjustment->warehouse ? $adjustment->warehouse->name : "-")
            ->addColumn('action', function ($adjustment) {
                return view('adjustment.partials.action', compact('adjustment'));
            })
            ->make(true);
    }
}
