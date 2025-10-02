<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
  public function index()
    {
        $cartItems = CartItem::all();

        $subtotal = $cartItems->sum(fn($item) => $item->product_price * $item->quantity);
        $shipping = 350; // default
        $tax = $subtotal * 0.08; // 8% tax
        $total = $subtotal + $shipping + $tax;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'shipping_method' => 'required|string',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string',
        ]);

        $cartItems = CartItem::all();
        $subtotal = $cartItems->sum(fn($item) => $item->product_price * $item->quantity);
        
        $shipping = match ($request->shipping_method) {
            'express' => 550,
            'overnight' => 850,
            default => 350,
        };

        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;

        // Save order
        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'shipping_method' => $request->shipping_method,
            'shipping_cost' => $shipping,
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'cvv' => $request->cvv,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ]);

        // Save order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product_name,
                'product_price' => $item->product_price,
                'quantity' => $item->quantity,
            ]);
        }

        // Clear cart
        CartItem::truncate();

        return redirect()->route('checkout.index')->with('success', '✅ Order placed successfully!');
    }

}
