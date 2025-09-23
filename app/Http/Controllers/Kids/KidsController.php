<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class KidsController extends Controller
{
    public function index(Request $request)
    {
        // Base query for Kids category

        $query = Product::where('category', 'Kids')
            ->orderBy('created_at', 'desc');
        // Size filter
        if ($request->filled('size')) {
            $query->where('sizes', 'LIKE', '%' . $request->size . '%');
        }

        // Color filter
        if ($request->filled('color')) {
            $query->where('colors', 'LIKE', '%' . $request->color . '%');
        }

        // Paginated products
        $products = $query->paginate(9);

        // Attach images_collection for each product
        foreach ($products as $product) {
            $product->images_collection = ProductImage::where('product_id', $product->id)->get();
        }

        // Available colors dynamically (based on Kids category)
        $colorQuery = Product::where('status', 1)->where('category', 'Kids');
        if ($request->filled('size')) {
            $colorQuery->where('sizes', 'LIKE', '%' . $request->size . '%');
        }

        $availableColors = $colorQuery->pluck('colors')
            ->flatMap(fn($colors) => array_map('trim', explode(',', $colors)))
            ->unique()
            ->values()
            ->all();

        return view('kids.index', compact('products', 'availableColors'));
    }

    public function show($id)
    {
        $product = Product::where('category', 'Kids')->findOrFail($id);

        $images = ProductImage::where('product_id', $id)->get();

        $relatedProducts = Product::where('category', 'Kids')
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('kids.show', compact('product', 'images', 'relatedProducts'));
    }
}
