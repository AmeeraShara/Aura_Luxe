<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KidsController extends Controller
{
    public function index(Request $request)
    {
        // Filter logic
        $query = Product::with('images_collection')
            ->where('status', 1)
            ->where('category', 'Kids'); // Assuming you store category as "Kids"

        // Size filter
        if ($request->filled('sizes')) {
            $query->where('sizes', 'LIKE', '%' . $request->size . '%');
        }

        // Color filter
        if ($request->filled('colors')) {
            $query->where('colors', 'LIKE', '%' . $request->color . '%');
        }

        $products = $query->paginate(9);

        // Available colors dynamically
        $availableColors = Product::where('category', 'Kids')
            ->pluck('colors')
            ->unique()
            ->filter();

        return view('kids.index', compact('products', 'availableColors'));
    }
}
