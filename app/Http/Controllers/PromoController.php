<?php

namespace App\Http\Controllers;

use App\Promo;
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
        return view('promo.create');
    }

    public function store(StorePromoRequest $request)
    {
        Promo::create($request->all());

        return redirect()->route('promo.index')->with('success', 'Promo created successfully.');
    }

    public function edit(Promo $promo)
    {
        return view('promo.edit', compact('promo'));
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
