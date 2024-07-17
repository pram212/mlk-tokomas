<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\paymentMethod;

class paymentMethodController extends Controller
{
    function getAll()
    {
        try {
            $paymentMethods = paymentMethod::all();
            return response()->json(['status' => true, 'data' => $paymentMethods, 'message' => 'Payment Methods retrieved successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'data' => null, 'message' => $e->getMessage()]);
        }
    }
}
