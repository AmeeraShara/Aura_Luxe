<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class WomenController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('category', 'Women'); // ✅ Only women’s products

        // Size filter
        if ($request->filled('size')) {
            $query->where('sizes', 'like', "%{$request->size}%");
        }

        // Color filter
        if ($request->filled('color')) {
            $query->where('colors', 'like', "%{$request->color}%");
        }

        // Paginated products
        $products = $query->paginate(12);

        // Attach product images
        foreach ($products as $product) {
            $product->images_collection = ProductImage::where('product_id', $product->id)->get();
        }

        // Available colors (based on size filter if applied)
        $colorQuery = Product::where('category', 'Women');
        if ($request->filled('size')) {
            $colorQuery->where('sizes', 'like', "%{$request->size}%");
        }

        $availableColors = $colorQuery->pluck('colors')
            ->flatMap(fn($colors) => array_map('trim', explode(',', $colors)))
            ->unique()
            ->values()
            ->all();

        return view('women.index', compact('products', 'availableColors'));
    }

    public function show($id)
    {
        $product = Product::where('category', 'Women')->findOrFail($id);

        $images = ProductImage::where('product_id', $id)->get();

        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('women.show', compact('product', 'images', 'relatedProducts'));
    }
}
