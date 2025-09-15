<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart\CartItem;
use App\Models\Product;
use App\Models\ProductImage;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $product = Product::with('images')->findOrFail($productId);


$firstImage = ProductImage::where('product_id', $productId)->first()->path ?? null;

        CartItem::create([
            'product_id'     => $product->id,
            'product_name'   => $product->name,
            'product_price'  => $product->price,
            'product_image'  => $firstImage,
            'selected_color' => $request->selected_color,
            'selected_size'  => $request->selected_size,
            'quantity'       => $request->quantity ?? 1,
        ]);

        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }

    public function index()
    {
        $cartItems = CartItem::all();

        $subtotal = $cartItems->sum(fn($item) => $item->product_price * $item->quantity);
        $shipping = ($subtotal > 5000) ? 0 : 500;
        $tax = $subtotal * 0.05;
        $total = $subtotal + $shipping + $tax;

        return view('cart.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function remove($id)
    {
        CartItem::destroy($id);
        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }

    public function update(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);
        $item->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index')->with('success', 'Quantity updated.');
    }
}
