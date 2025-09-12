<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
}
