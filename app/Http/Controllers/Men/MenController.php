<?php

namespace App\Http\Controllers\Men;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class MenController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('category', 'Men')
            ->orderBy('created_at', 'desc');

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
        $colorQuery = Product::where('category', 'Men');
        if ($request->filled('size')) {
            $colorQuery->where('sizes', 'like', "%{$request->size}%");
        }

        $availableColors = $colorQuery->pluck('colors')
            ->flatMap(fn($colors) => array_map('trim', explode(',', $colors)))
            ->unique()
            ->values()
            ->all();

        return view('men.index', compact('products', 'availableColors'));
    }

    public function show($id)
    {
        $product = Product::where('category', 'Men')->findOrFail($id);

        $images = ProductImage::where('product_id', $id)->get();

        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('men.show', compact('product', 'images', 'relatedProducts'));
    }
}
