<?php

namespace App\Http\Controllers\Accessories;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
public function index(Request $request)
{
    $query = Product::where('category', 'Accessories')
        ->orderBy('created_at', 'desc');

    // Filter by size
    if ($request->filled('size')) {
        $query->where('sizes', 'like', "%{$request->size}%");
    }

    // Filter by color
    if ($request->filled('color')) {
        $query->where('colors', 'like', "%{$request->color}%");
    }

    // Filter by subcategory
    if ($request->filled('subcategory')) {
        $query->where('subcategory', $request->subcategory);
    }

    $products = $query->paginate(12);

    // Attach images
    foreach ($products as $product) {
        $product->images_collection = ProductImage::where('product_id', $product->id)->get();
    }

    // Available colors
    $colorQuery = Product::where('category', 'Accessories');
    if ($request->filled('size')) {
        $colorQuery->where('sizes', 'like', "%{$request->size}%");
    }

    $availableColors = $colorQuery->pluck('colors')
        ->flatMap(fn($colors) => array_map('trim', explode(',', $colors)))
        ->unique()
        ->values()
        ->all();

    // ✅ Distinct subcategories for Accessories
$subcategories = [
    'Men' => ['Shirts', 'T-Shirts', 'Bottoms', 'Trousers', 'Shoes'],
    'Women' => ['Dresses', 'Tops', 'Shoes'],
    'Kids' => ['Boys', 'Girls'],
    'Accessories' => ['Men', 'Women', 'Bags', 'Jewelry', 'Watches'],
];

    return view('accessories.index', compact('products', 'availableColors', 'subcategories'));
}

}
