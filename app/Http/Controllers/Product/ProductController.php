<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->category = $request->category;
        $product->subcategory = $request->subcategory; 
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->sizes = $request->sizes ? implode(',', $request->sizes) : null;
        $product->colors = $request->colors ? implode(',', $request->colors) : null;
        $product->description = $request->description;
        $product->status = $request->has('status') ? 1 : 0;
        $product->save();

        // Save multiple images in separate table
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $fileName = time() . '_' . $index . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $fileName);

                $product->images()->create([
                    'path' => 'uploads/products/' . $fileName
                ]);
            }
        }

        return redirect()->route('products.create')->with('success', '✅ Product saved successfully!');
    }

    public function show($id)
    {
        // Get product
        $product = Product::findOrFail($id);

        // ✅ Fetch images separately using product_id
        $images = ProductImage::where('product_id', $id)->get();

        // ✅ Related products (same category, exclude current)
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'images', 'relatedProducts'));
    }
}
