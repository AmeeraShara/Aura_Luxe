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
        $product->color = $request->color;
        $product->description = $request->description;
        $product->status = $request->has('status') ? 1 : 0;

        // Handle multiple image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $fileName);
                $imagePaths[] = 'uploads/products/'.$fileName;
            }
        }
        $product->images = $imagePaths ? implode(',', $imagePaths) : null;

        $product->save();

        return redirect()->route('products.create')->with('success', '✅ Product saved successfully!');
    }
}
