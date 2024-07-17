<?php

namespace App\Http\Controllers;

use App\Promo;
use App\ProductProperty;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdatePromoRequest;
use App\Http\Requests\StorePromoRequest;

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
        return view('promo.form', compact('promo'));
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
        return view('promo.show', compact('promo'));
    }

    public function destroyAll(Request $request)
    {
        Promo::whereIn('id', explode(",", $request->ids))->delete();

        return response()->json(['success' => "Promo deleted successfully."]);
    }
}
