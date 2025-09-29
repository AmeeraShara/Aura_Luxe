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
    // 1. Latest 8 active products with their first image
$products = Product::where('status', 1)
    ->latest()
    ->paginate(4); // Use paginate() instead of take() + get()

// Then map images separately (you can do it via eager loading instead, better approach)
$products->getCollection()->transform(function ($product) {
    $image = ProductImage::where('product_id', $product->id)->first();
    $product->first_image = $image ? asset($image->path) : asset('images/default.jpg');
    return $product;
});


    // 2. Define specific categories or pull distinct ones
    $categoryList = ['Men', 'Women', 'Kids', 'Sale', 'Accessories']; // Optional: static list
    $collections = [];

    foreach ($categoryList as $category) {
        $product = Product::where('category', $category)->first();

        if ($product) {
            $image = ProductImage::where('product_id', $product->id)->first();
            $collections[] = [
                'name' => $category,
                'route' => strtolower($category) . '.index',
                'image' => $image ? asset($image->path) : asset('images/no-image.png'),
            ];
        } else {
            // No product found, fallback image
            $collections[] = [
                'name' => $category,
                'route' => strtolower($category) . '.index',
                'image' => asset('images/no-image.png'),
            ];
        }
    }

    return view('front', compact('products', 'collections'));
}

}
