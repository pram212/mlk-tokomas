<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function product_status()
    {
        /* Product Status */
        /* 0 = SOLD, 1 = STORE, 2 = Transfer to Gudang */

        $status = [
            ['id' => 0, 'name' => 'SOLD'],
            ['id' => 1, 'name' => 'STORE'],
            ['id' => 2, 'name' => 'Transfer to Gudang'],
        ];

        return response()->json(['status' => 'success', 'data' => $status, 'message' => ''], 200);
    }
}
