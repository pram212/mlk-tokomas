<?php

namespace App\Http\Controllers\api;


use App\Promo;
use Illuminate\Http\Request;
use App\Helpers\PermissionHelpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $query = Promo::with('product_properties');
        DB::statement("SET sql_mode = '' ");

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('product_property', function ($promo) {
                return $promo->product_properties->description;
            })
            ->addColumn('action', function ($promo) {
                return view('promo.partials.list_actions', compact('promo'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
