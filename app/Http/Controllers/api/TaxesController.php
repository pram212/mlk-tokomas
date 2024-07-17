<?php

namespace App\Http\Controllers\api;

use App\Tax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxesController extends Controller
{
    function getAll(Request $request)
    {
        try {
            $taxes = Tax::all()->where('is_active', 1);

            $no_tax = new Tax();
            $no_tax = [
                'id' => 0,
                'name' => 'No Tax',
                'rate' => 0,
                'is_active' => 1
            ];
            $taxes->push($no_tax);

            return response()->json(['status' => true, 'data' => $taxes, 'message' => '']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
