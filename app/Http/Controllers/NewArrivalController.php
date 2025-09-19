<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewArrivalController extends Controller
{
    public function index()
    {
        // Fetch paginated products
        $products = Product::paginate(12);

        // Attach first_image property to each product by querying ProductImage directly
        foreach ($products as $product) {
            $firstImage = ProductImage::where('product_id', $product->id)->first();
            $product->first_image = $firstImage ? $firstImage->path : null;
        }

        return view('newarrival.index', compact('products'));
    }


}
