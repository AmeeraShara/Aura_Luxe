@extends('layouts.app')

@section('content')
<style>
    /* Filter Bar */
    .filter-bar {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 10px 15px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 15px;
        font-size: 0.85rem;
    }

    .filter-icon {
        font-size: 1.2rem;
        margin-right: 10px;
        display: flex;
        align-items: center;
        font-weight: bold;
    }

    .filter-section {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .size-button {
        border: 1px solid #ccc;
        padding: 5px 10px;
        font-size: 0.75rem;
        border-radius: 4px;
        background-color: #f9f9f9;
        cursor: pointer;
        transition: 0.2s;
    }

    .size-button:hover,
    .size-button.active {
        background-color: #000;
        color: #fff;
    }

    .color-box {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 1px solid #ccc;
        cursor: pointer;
        display: inline-block;
        transition: 0.2s;
    }

    .color-box:hover,
    input[type="radio"]:checked + .color-box {
        border: 2px solid #000;
    }

    .btn-apply {
        background-color: #ccc;
        border: none;
        padding: 6px 14px;
        font-size: 0.8rem;
        border-radius: 4px;
        color: #000;
    }

    /* Hide native radios */
    .hidden-radio {
        display: none;
    }

    /* Product card styles remain unchanged */
    .card-img-top {
        height: 220px;
        object-fit: cover;
    }

    .card-body .btn {
        margin: 5px 3px;
        font-size: 0.8rem;
    }

    .product-card {
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: scale(1.03);
    }
</style>

<div class="container-fluid py-4">

    <!-- FILTER BAR -->
    <form method="GET" action="{{ route('newarrival.index') }}">
        <div class="filter-bar">

            <!-- Filter Icon -->
            <div class="filter-icon">
                <span>🔽 Filter</span>
            </div>

            <!-- Sizes -->
            <div class="filter-section">
                <span>Size:</span>
                @foreach(['XS', 'S', 'M', 'L', 'XL'] as $size)
                    <label>
                        <input type="radio" name="size" value="{{ $size }}" class="hidden-radio">
                        <span class="size-button">{{ $size }}</span>
                    </label>
                @endforeach
            </div>

            <!-- Colors -->
            <div class="filter-section">
                <span>Color:</span>
                @foreach(['red', 'green', 'blue', 'black', 'white', 'pink', 'orange', 'purple'] as $color)
                    <label>
                        <input type="radio" name="color" value="{{ $color }}" class="hidden-radio">
                        <span class="color-box" style="background-color: {{ $color }};"></span>
                    </label>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="ms-auto">
                <button type="submit" class="btn-apply">Apply</button>
            </div>
        </div>
    </form>

    <!-- PRODUCT GRID -->
    <div class="row mt-4 product-grid">
        @forelse($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100 product-card">
                <img 
                    src="{{ $product->first_image ? asset('uploads/' . $product->first_image) : asset('images/no-image.png') }}" 
                    alt="{{ $product->name }}" 
                    class="card-img-top"
                >
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">LKR {{ number_format($product->price, 2) }}</p>
                    <a href="#" class="btn btn-outline-danger btn-sm">♡</a>
                    <a href="#" class="btn btn-outline-success btn-sm">🛒</a>
                </div>
            </div>
        </div>
        @empty
        <p>No products found.</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
