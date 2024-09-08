<?php

namespace App\Http\Controllers;

use App\Promo;
use Carbon\Carbon;
use App\ProductProperty;
use Illuminate\Http\Request;
use App\Http\Requests\StorePromoRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdatePromoRequest;

class PromoController extends Controller
{
    public function index()
    {
        return view('promo.index');
    }

    public function create()
    {
        $product_properties = ProductProperty::all();
        return view('promo.form', compact('product_properties'));
    }

    public function store(StorePromoRequest $request)
    {
        try {
            Promo::create($request->all());
            return redirect()->route('promo.index')->with('created-success', 'Promo created successfully');
        } catch (\Exception $e) {
            return redirect()->route('promo.index')->with('message', 'Promo failed to create');
        }
    }

    public function edit(Promo $promo)
    {
        $product_properties = ProductProperty::all();
        $promo->start_period = Carbon::parse($promo->start_period)->format('Y-m-d') ?? '';
        $promo->end_period = Carbon::parse($promo->end_period)->format('Y-m-d') ?? '';
        $promo->discount = number_format($promo->discount, 0, ',', '.');
        return view('promo.form', compact('promo', 'product_properties'));
    }

    public function update(UpdatePromoRequest $request, Promo $promo)
    {
        $promo->update($request->all());

        return redirect()->route('promo.index')->with('success', 'Promo updated successfully');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();

        return redirect()->route('promo.index')
            ->with('success', 'Promo deleted successfully');
    }

    public function show(Promo $promo)
    {
        $product_properties = ProductProperty::all();
        $promo->start_period = Carbon::parse($promo->start_period)->format('Y-m-d') ?? '';
        $promo->end_period = Carbon::parse($promo->end_period)->format('Y-m-d') ?? '';
        $promo->discount = number_format($promo->discount, 0, ',', '.');
        $is_readonly = true;
        return view('promo.form', compact('promo', 'product_properties', 'is_readonly'));
    }

    public function destroyAll(Request $request)
    {
        Promo::whereIn('id', explode(",", $request->ids))->delete();

        return response()->json(['success' => "Promo deleted successfully."]);
    }
    public function getPromoProduct($product_properties_id)
    {
        $price = Promo::where('product_properties_id', $product_properties_id)->first();

        return response()->json($price);
    }
}
