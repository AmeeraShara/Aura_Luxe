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

    /* Product card styles */
    .card-img-top {
        height: 180px;
        object-fit: contain;
    }

    .product-card {
        width: 200px;
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: scale(1.03);
    }

    .card-body .btn {
        margin: 5px 3px;
        font-size: 0.7rem;
    }
</style>

<div class="container py-4">
    <h2 class="fw-bold mb-4 text-center"> Accessories Collection</h2>

    <!-- FILTER BAR -->
    <form method="GET" action="{{ route('accessories.index') }}" id="filter-form">
        <div class="filter-bar">

            <div class="filter-icon"><span>🔽 Filter</span></div>

            <!-- Sizes -->
            <div class="filter-section">
                <span>Size:</span>
                @foreach(['XS','S','M','L','XL','XXL','XXXL'] as $size)
                    <label>
                        <input type="radio" name="size" value="{{ $size }}" class="hidden-radio filter-input"
                            {{ request('size') === $size ? 'checked' : '' }}>
                        <span class="size-button {{ request('size') === $size ? 'active' : '' }}">{{ $size }}</span>
                    </label>
                @endforeach
            </div>

            <!-- Colors -->
            <div class="filter-section">
                <span>Color:</span>
                @foreach($availableColors as $color)
                    <label>
                        <input type="radio" name="color" value="{{ $color }}" class="hidden-radio filter-input"
                            {{ request('color') === $color ? 'checked' : '' }}>
                    <span class="color-box" style="<?php echo 'background-color:' . $color; ?>;" data-color="<?php echo $color; ?>"></span>
                    </label>
                @endforeach
            </div>

            <!-- Reset -->
            <div class="ms-auto">
                <a href="{{ route('accessories.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- PRODUCT GRID -->
    <div class="row mt-4 product-grid">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 product-card">
                    @php
                        $firstImagePath = optional($product->images_collection->first())->path;
                    @endphp
                    <img src="{{ $firstImagePath ? asset($firstImagePath) : asset('images/no-image.png') }}"
                         alt="{{ $product->name }}"
                         class="card-img-top">

                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text fw-bold">
                            LKR {{ number_format($product->price, 2) }}
                        </p>
                        <a href="#" class="btn btn-outline-danger btn-sm">♡</a>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-success btn-sm">🛒</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No accessories found.</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}
    </div>
</div>

<!-- Auto-submit filters -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.filter-input').forEach(input => {
            input.addEventListener('change', () => {
                document.getElementById('filter-form').submit();
            });
        });
    });
</script>
@endpush
@endsection
