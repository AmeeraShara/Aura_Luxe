<?php

namespace App\Http\Controllers\NewArrival;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class NewArrivalController extends Controller
{
    public function index(Request $request)
{
    $query = Product::orderBy('created_at', 'desc');

    // Apply size filter
    if ($request->filled('size')) {
        $query->where('sizes', 'like', "%{$request->size}%");
    }

    // Apply color filter
    if ($request->filled('color')) {
        $query->where('colors', 'like', "%{$request->color}%");
    }

    // Get only the first 12 filtered products (no pagination)
$products = $query->paginate(12);

    // Attach related images
    foreach ($products as $product) {
        $product->images_collection = ProductImage::where('product_id', $product->id)->get();
    }

    // Get available colors (based on size filter)
    $colorQuery = Product::query();

    if ($request->filled('size')) {
        $colorQuery->where('sizes', 'like', "%{$request->size}%");
    }

    $availableColors = $colorQuery->pluck('colors')
        ->flatMap(fn($colors) => array_map('trim', explode(',', $colors)))
        ->unique()
        ->values()
        ->all();

    return view('newarrival.index', compact('products', 'availableColors'));
}

}
