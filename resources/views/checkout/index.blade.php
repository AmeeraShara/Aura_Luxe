@extends('layouts.app')

@section('content')
<style>
    .checkout-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 40px 0;
    }
    
    .checkout-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }
    
    .checkout-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    
    .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        padding: 20px;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }
    
    .card-header-dark {
        background: linear-gradient(135deg, #434343 0%, #000000 100%);
        color: white;
        font-weight: 600;
        padding: 20px;
        font-size: 1.1rem;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        border: 2px solid #e0e0e0;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .shipping-option {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }
    
    .shipping-option:hover {
        border-color: #667eea;
        background: #f8f9ff;
        transform: scale(1.02);
    }
    
    .shipping-option input[type="radio"]:checked + label {
        color: #667eea;
        font-weight: 600;
    }
    
    .shipping-option input[type="radio"]:checked ~ .shipping-details {
        color: #667eea;
    }
    
    .order-summary-item {
        border: none;
        border-bottom: 1px solid #f0f0f0;
        padding: 15px 0;
        transition: background 0.3s ease;
    }
    
    .order-summary-item:hover {
        background: #f8f9ff;
        padding-left: 10px;
    }
    
    .order-summary-item:last-child {
        border-bottom: none;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        font-size: 1rem;
    }
    
    .summary-total {
        border-top: 3px solid #667eea;
        padding-top: 20px;
        margin-top: 15px;
    }
    
    .btn-place-order {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 18px;
        font-size: 1.2rem;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .btn-place-order:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }
    
    .secure-badge {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 10px 20px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        margin-top: 15px;
    }
    
    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 15px;
    }
    
    @media (max-width: 768px) {
        .checkout-container {
            padding: 20px 0;
        }
        
        .card-header-custom, .card-header-dark {
            font-size: 1rem;
            padding: 15px;
        }
        
        .btn-place-order {
            font-size: 1rem;
            padding: 15px;
        }
    }
</style>

<div class="checkout-container">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h1 class="display-4 fw-bold mb-2" style="color: #434343;">Secure Checkout</h1>
                <p class="text-muted">Complete your purchase safely and securely</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.placeOrder') }}">
            @csrf
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-8">
                    
                    <!-- Shipping Information -->
                    <div class="card checkout-card mb-4">
                        <div class="card-header-custom">
                            <i class="fas fa-shipping-fast me-2"></i>Shipping Information
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name *</label>
                                    <input type="text" class="form-control" name="name" placeholder="John Doe" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email Address *</label>
                                    <input type="email" class="form-control" name="email" placeholder="john@example.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Phone Number *</label>
                                    <input type="tel" class="form-control" name="phone" placeholder="+94 71 234 5678" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Street Address *</label>
                                    <input type="text" class="form-control" name="address" placeholder="123 Main Street" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">City *</label>
                                    <input type="text" class="form-control" name="city" placeholder="Colombo" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Postal Code *</label>
                                    <input type="text" class="form-control" name="postal_code" placeholder="00100" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Country *</label>
                                    <input type="text" class="form-control" name="country" placeholder="Sri Lanka" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Method -->
                    <div class="card checkout-card mb-4">
                        <div class="card-header-custom">
                            <i class="fas fa-truck me-2"></i>Shipping Method
                        </div>
                        <div class="card-body p-4">
                            <div class="shipping-option">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method" value="standard" id="standard" checked>
                                    <label class="form-check-label w-100 d-flex justify-content-between align-items-center" for="standard">
                                        <div>
                                            <div class="fw-bold">Standard Shipping</div>
                                            <small class="text-muted shipping-details">Delivery in 5-7 business days</small>
                                        </div>
                                        <span class="fw-bold">LKR 350</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="shipping-option">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method" value="express" id="express">
                                    <label class="form-check-label w-100 d-flex justify-content-between align-items-center" for="express">
                                        <div>
                                            <div class="fw-bold">Express Shipping</div>
                                            <small class="text-muted shipping-details">Delivery in 2-3 business days</small>
                                        </div>
                                        <span class="fw-bold">LKR 550</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="shipping-option">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method" value="overnight" id="overnight">
                                    <label class="form-check-label w-100 d-flex justify-content-between align-items-center" for="overnight">
                                        <div>
                                            <div class="fw-bold">Overnight Shipping</div>
                                            <small class="text-muted shipping-details">Delivery in 1 business day</small>
                                        </div>
                                        <span class="fw-bold">LKR 850</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="card checkout-card mb-4">
                        <div class="card-header-custom">
                            <i class="fas fa-credit-card me-2"></i>Payment Information
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Card Number *</label>
                                    <input type="text" class="form-control" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Expiry Date *</label>
                                    <input type="text" class="form-control" name="expiry_date" placeholder="MM/YY" maxlength="5" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">CVV *</label>
                                    <input type="text" class="form-control" name="cvv" placeholder="123" maxlength="3" required>
                                </div>
                            </div>
                            <div class="secure-badge">
                                <i class="fas fa-lock"></i>
                                <span>Your payment information is secure and encrypted</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Order Summary -->
                <div class="col-lg-4">
                    <div class="card checkout-card sticky-top" style="top: 20px;">
                        <div class="card-header-dark">
                            <i class="fas fa-receipt me-2"></i>Order Summary
                        </div>
                        <div class="card-body p-4">
                            <!-- Cart Items -->
                            <div class="mb-3">
                                @foreach($cartItems as $item)
                                    <div class="order-summary-item d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <div>
                                                <div class="fw-semibold">{{ $item->product_name }}</div>
                                                <small class="text-muted">Quantity: {{ $item->quantity }}</small>
                                            </div>
                                        </div>
                                        <div class="fw-bold">LKR {{ number_format($item->product_price * $item->quantity, 2) }}</div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Summary Calculations -->
                            <div class="summary-row text-muted">
                                <span>Subtotal</span>
                                <span>LKR {{ number_format($subtotal, 2) }}</span>
                            </div>
                            
                            <div class="summary-row text-muted">
                                <span>Shipping</span>
                                <span>LKR {{ number_format($shipping, 2) }}</span>
                            </div>
                            
                            <div class="summary-row text-muted">
                                <span>Tax</span>
                                <span>LKR {{ number_format($tax, 2) }}</span>
                            </div>

                            <!-- Total -->
                            <div class="summary-row summary-total">
                                <span class="h5 mb-0 fw-bold">Total</span>
                                <span class="h4 mb-0 fw-bold" style="color: #667eea;">LKR {{ number_format($total, 2) }}</span>
                            </div>

                            <!-- Place Order Button -->
                            <button type="submit" class="btn btn-place-order w-100 mt-4">
                                <i class="fas fa-lock me-2"></i>Place Order
                            </button>

                            <!-- Trust Badges -->
                            <div class="text-center mt-4">
                                <small class="text-muted d-block mb-2">We Accept</small>
                                <div class="d-flex justify-content-center gap-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" style="height: 25px;" alt="Visa">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" style="height: 25px;" alt="Mastercard">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Format card number input
    document.querySelector('input[name="card_number"]').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s/g, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        e.target.value = formattedValue;
    });

    // Format expiry date
    document.querySelector('input[name="expiry_date"]').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.slice(0, 2) + '/' + value.slice(2, 4);
        }
        e.target.value = value;
    });

    // Only allow numbers in CVV
    document.querySelector('input[name="cvv"]').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });
</script>
@endpush

@endsection