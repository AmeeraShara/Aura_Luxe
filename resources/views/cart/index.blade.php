@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<div class="container">
    <h1 class="cart-title">🛒 Your Shopping Cart</h1>

        @auth
        <p class="text-muted">Logged in as: <strong>{{ Auth::user()->email }}</strong></p>
    @endauth
    
    @if($cartItems->isEmpty())
    <div class="empty-cart">
        <p>Your cart is currently empty.</p>
        <a href="{{ url('/') }}">🛍️ Start Shopping</a>
    </div>
    @else
    <div class="cart-grid">
        <!-- Cart Items -->
        <div class="space-y-4">
            @foreach($cartItems as $item)
            <div class="cart-item">
                <img src="{{ asset($item->product_image ?? 'uploads/products/default.jpg') }}" class="cart-image">
                <div class="cart-details">
                    <div>
                        <h3>{{ $item->product_name }}</h3>
                        <p>
                            Sizes: {{ $item->selected_sizes ? implode(', ', $item->selected_sizes) : '-' }} |
                            Colors: {{ $item->selected_colors ? implode(', ', $item->selected_colors) : '-' }}
                        </p>


                    </div>
                    <div class="cart-actions">
                        <form method="POST" action="{{ route('cart.update', $item->id) }}">
                            @csrf @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                            <button type="submit">Update</button>
                        </form>
                        <p class="cart-price">
                            LKR {{ number_format($item->product_price * $item->quantity, 2) }}
                        </p>
                        <form method="POST" action="{{ route('cart.remove', $item->id) }}" class="cart-remove">
                            @csrf @method('DELETE')
                            <button>Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h2>Order Summary</h2>
            <p><span>Subtotal:</span> <strong>LKR {{ number_format($subtotal, 2) }}</strong></p>
            <p><span>Shipping:</span>
                <strong>{{ $shipping == 0 ? 'Free' : 'LKR ' . number_format($shipping, 2) }}</strong>
            </p>
            <p><span>Tax (5%):</span> <strong>LKR {{ number_format($tax, 2) }}</strong></p>
            <hr>
            <p class="total"><span>Total:</span> <strong>LKR {{ number_format($total, 2) }}</strong></p>
            <div class="summary-buttons">
                <a href="{{ route('products.show', $cartItems->first()->product_id) }}" class="btn-continue">⬅ Continue Shopping</a>
                <a href="{{ url('/checkout') }}" class="btn-checkout">🛒 Proceed to Checkout</a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection