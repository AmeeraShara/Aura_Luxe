<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;

class HomeController extends Controller
{
    public function index()
    {
        // Latest 8 active products with first image eager loaded
        $products = Product::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get()
            ->map(function($product) {
                $product->first_image = ProductImage::where('product_id', $product->id)->first()->path ?? 'images/default.jpg';
                return $product;
            });

        // Distinct categories for Shop by Category
        $categories = Product::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->get();

        return view('front', compact('products', 'categories'));
    }
}
