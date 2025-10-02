<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart\CartItem;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add product to cart
     */
    public function add(Request $request, $productId)
    {

            if (!Auth::check()) {
        // If not logged in, show login form popup OR redirect to login
        return redirect()->route('login')->with('error', 'You must log in to add items to cart.');
    }
        $product = Product::with('images')->findOrFail($productId);
        $firstImage = ProductImage::where('product_id', $productId)->first()->path ?? null;

        // Handle multiple selections (checkbox arrays)
        $selectedColors = $request->input('selected_colors', []); 
        $selectedSizes  = $request->input('selected_sizes', []);  

        CartItem::create([
                'user_id'        => Auth::id(),
            'product_id'      => $product->id,
            'product_name'    => $product->name,
            'product_price'   => $product->price,
            'product_image'   => $firstImage,
            'selected_colors' => $selectedColors, // automatically cast to JSON
            'selected_sizes'  => $selectedSizes,  // automatically cast to JSON
            'quantity'        => $request->quantity ?? 1,
        ]);

        return redirect()->route('cart.index')->with('success', '✅ Item added to cart!');
    }

    /**
     * Show cart
     */
    public function index()
    {
            if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to view your cart.');
    }

    $cartItems = CartItem::where('user_id', Auth::id())->get();

        // ✅ Totals
        $subtotal = $cartItems->sum(fn($item) => $item->product_price * $item->quantity);
        $shipping = $subtotal >= 10000 ? 0 : 500;
        $tax = $subtotal * 0.05;
        $total = $subtotal + $shipping + $tax;

        return view('cart.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    /**
     * Remove item
     */
    public function remove($id)
    {
            if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in first.');
    }
        CartItem::where('user_id', Auth::id())->where('id', $id)->delete();
        return redirect()->route('cart.index')->with('success', '🗑 Item removed.');
    }

    /**
     * Update item quantity
     */
    public function update(Request $request, $id)
    {
            if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in first.');
    }
        $item = CartItem::findOrFail($id);
        $item->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index')->with('success', '🔄 Quantity updated.');
    }
}
