<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    public function index()
    {
        return view('product_stock.index');
    }
}
