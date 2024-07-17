<?php

namespace App\Http\Controllers\api;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class categoriesController extends Controller
{
    function getAll(Request $request)
    {
        $categories = Category::when($request->has('search'), function ($query) use ($request) {
            $query->orWhere('name', 'like', '%' . $request->search . '%');
        })
            ->select(['id', 'name'])
            ->where('is_active', 1)
            ->orderBy('name', 'asc')
            ->get();
        return response()->json($categories);
    }

    public function changeStatus(Request $request)
    {
        try {
            $category = Category::findOrFail($request->id);

            if (!$category) return response()->json(['isSuccess' => false, 'message' => 'Category not found']);
            $products = Product::where('category_id', $category->id)->first();
            if ($category->is_active && $products) {
                return response()->json([
                    'isSuccess' => false,
                    'message' => "Category is currently in use by products <b>$products->name</b> and cannot be deactivated."
                ]);
            }
            $category->is_active = !$category->is_active;
            $category->save();

            return response()->json([
                'isSuccess' => true,
                'message' => 'Category status changed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'isSuccess' => false,
                'message' => 'There was an issue changing the category status'
            ]);
        }
    }
}
