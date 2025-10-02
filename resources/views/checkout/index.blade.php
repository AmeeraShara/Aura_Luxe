@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('checkout.placeOrder') }}">
        @csrf

        <!-- Shipping Info -->
        <div class="card mb-4">
            <div class="card-header fw-bold">Shipping Information</div>
            <div class="card-body row g-3">
                <div class="col-md-6"><input class="form-control" name="name" placeholder="Full Name" required></div>
                <div class="col-md-6"><input class="form-control" name="email" placeholder="Email" required></div>
                <div class="col-md-6"><input class="form-control" name="phone" placeholder="Phone" required></div>
                <div class="col-md-6"><input class="form-control" name="address" placeholder="Address" required></div>
                <div class="col-md-4"><input class="form-control" name="city" placeholder="City" required></div>
                <div class="col-md-4"><input class="form-control" name="postal_code" placeholder="Postal Code" required></div>
                <div class="col-md-4"><input class="form-control" name="country" placeholder="Country" required></div>
            </div>
        </div>

        <!-- Shipping Method -->
        <div class="card mb-4">
            <div class="card-header fw-bold">Shipping Method</div>
            <div class="card-body">
                <div class="form-check"><input type="radio" name="shipping_method" value="standard" checked> Standard (LKR 350, 5-7 days)</div>
                <div class="form-check"><input type="radio" name="shipping_method" value="express"> Express (LKR 550, 2-3 days)</div>
                <div class="form-check"><input type="radio" name="shipping_method" value="overnight"> Overnight (LKR 850, 1 day)</div>
            </div>
        </div>

        <!-- Payment -->
        <div class="card mb-4">
            <div class="card-header fw-bold">Payment Information</div>
            <div class="card-body row g-3">
                <div class="col-md-6"><input class="form-control" name="card_number" placeholder="Card Number" required></div>
                <div class="col-md-3"><input class="form-control" name="expiry_date" placeholder="MM/YY" required></div>
                <div class="col-md-3"><input class="form-control" name="cvv" placeholder="CVV" required></div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="card mb-4">
            <div class="card-header fw-bold">Order Summary</div>
            <div class="card-body">
                <ul class="list-group mb-3">
                    @foreach($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $item->product_name }} (x{{ $item->quantity }})
                            <span>LKR {{ number_format($item->product_price * $item->quantity, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
                <p>Subtotal: <strong>LKR {{ number_format($subtotal, 2) }}</strong></p>
                <p>Shipping: <strong>LKR {{ number_format($shipping, 2) }}</strong></p>
                <p>Tax: <strong>LKR {{ number_format($tax, 2) }}</strong></p>
                <h5>Total: <strong>LKR {{ number_format($total, 2) }}</strong></h5>
            </div>
        </div>

        <button class="btn btn-primary w-100">Place Order</button>
    </form>
</div>
@endsection
