<?php

namespace App\Http\Controllers\Collections;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        // Define the categories you want to show
        $categories = ['Men', 'Women', 'Kids', 'Sale', 'Accessories'];

        $collections = [];

        foreach ($categories as $category) {
            // Fetch first product in this category to get a representative image
            $product = Product::where('category', $category)->first();

            if ($product) {
                $image = ProductImage::where('product_id', $product->id)->first();
                $collections[] = [
                    'name' => $category,
                    'route' => strtolower($category) . '.index',
                    'image' => $image ? asset($image->path) : asset('images/no-image.png'),
                ];
            } else {
                // Fallback if no product exists
                $collections[] = [
                    'name' => $category,
                    'route' => strtolower($category) . '.index',
                    'image' => asset('images/no-image.png'),
                ];
            }
        }

        return view('collections.index', compact('collections'));
    }
}
