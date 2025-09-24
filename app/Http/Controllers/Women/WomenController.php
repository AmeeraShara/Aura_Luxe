<?php

namespace App\Http\Controllers\Women;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class WomenController extends Controller
{
   public function index(Request $request)
{
    $query = Product::where('category', 'Women')
        ->orderBy('created_at', 'desc');

    // Size filter
    if ($request->filled('size')) {
        $query->where('sizes', 'like', "%{$request->size}%");
    }

    // Color filter
    if ($request->filled('color')) {
        $query->where('colors', 'like', "%{$request->color}%");
    }

    // Subcategory filter
    if ($request->filled('subcategory')) {
        $query->where('subcategory', $request->subcategory);
    }

    // Paginated products
    $products = $query->paginate(12);

    // Attach product images
    foreach ($products as $product) {
        $product->images_collection = ProductImage::where('product_id', $product->id)->get();
    }

    // Available colors dynamically
    $colorQuery = Product::where('category', 'Women');
    if ($request->filled('size')) {
        $colorQuery->where('sizes', 'like', "%{$request->size}%");
    }

    $availableColors = $colorQuery->pluck('colors')
        ->flatMap(fn($colors) => array_map('trim', explode(',', $colors)))
        ->unique()
        ->values()
        ->all();

    // ✅ Fetch distinct subcategories for Women
$subcategories = [
    'Men' => ['Shirts', 'T-Shirts', 'Bottoms', 'Trousers', 'Shoes'],
    'Women' => ['Dresses', 'Tops', 'Shoes'],
    'Kids' => ['Boys', 'Girls'],
    'Accessories' => ['Men', 'Women', 'Bags', 'Jewelry', 'Watches'],
];

    return view('women.index', compact('products', 'availableColors', 'subcategories'));
}

}
