<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Size filter
        if ($request->filled('size')) {
            $query->where('sizes', 'like', "%{$request->size}%");
        }

        // Color filter
        if ($request->filled('color')) {
            $query->where('colors', 'like', "%{$request->color}%");
        }

        $products = $query->paginate(12);

        // Attach images
        foreach ($products as $product) {
            $product->images_collection = ProductImage::where('product_id', $product->id)->get();
        }

        // Available colors for filter
        $colorQuery = Product::query();
        if ($request->filled('size')) {
            $colorQuery->where('sizes', 'like', "%{$request->size}%");
        }

        $availableColors = $colorQuery->pluck('colors')
            ->flatMap(fn($colors) => array_map('trim', explode(',', $colors)))
            ->unique()
            ->values()
            ->all();

        return view('sale.index', compact('products', 'availableColors'));
    }
}
