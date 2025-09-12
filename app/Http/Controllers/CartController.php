<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Get cart from session
        $cart = Session::get('cart', []);

        // If product already in cart, increase qty
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->input('quantity', 1);
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->input('quantity', 1),
                'image' => $product->images->first()->path ?? 'default.jpg'
            ];
        }

        // Save cart back to session
        Session::put('cart', $cart);

        return redirect()->back()->with('success', '✅ Product added to cart!');
    }
    public function index()
{
    $cart = Session::get('cart', []);
    return view('cart.index', compact('cart'));
}

}
