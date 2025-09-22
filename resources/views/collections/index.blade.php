@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Our Collections</h2>

    <div class="row g-4 justify-content-center">

        <!-- Men -->
        <div class="col-md-4">
            <a href="{{ route('men.index') }}" class="text-decoration-none">
                <div class="card collection-card h-100 shadow-sm">
                    <img src="{{ asset('images/collections/men.jpg') }}" class="card-img-top" alt="Men">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Men</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- Women -->
        <div class="col-md-4">
            <a href="{{ route('women.index') }}" class="text-decoration-none">
                <div class="card collection-card h-100 shadow-sm">
                    <img src="{{ asset('images/collections/women.jpg') }}" class="card-img-top" alt="Women">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Women</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- Kids -->
        <div class="col-md-4">
            <a href="{{ route('kids.index') }}" class="text-decoration-none">
                <div class="card collection-card h-100 shadow-sm">
                    <img src="{{ asset('images/collections/kids.jpg') }}" class="card-img-top" alt="Kids">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Kids</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- Sale -->
        <div class="col-md-4">
            <a href="{{ route('sale.index') }}" class="text-decoration-none">
                <div class="card collection-card h-100 shadow-sm">
                    <img src="{{ asset('images/collections/sale.jpg') }}" class="card-img-top" alt="Sale">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Sale</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- Accessories -->
        <div class="col-md-4">
            <a href="{{ route('accessories.index') }}" class="text-decoration-none">
                <div class="card collection-card h-100 shadow-sm">
                    <img src="{{ asset('images/collections/accessories.jpg') }}" class="card-img-top" alt="Accessories">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Accessories</h5>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

<style>
    .collection-card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }

    .collection-card img {
        height: 250px;
        object-fit: cover;
    }

    .collection-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .collection-card h5 {
        margin-top: 10px;
        color: #000;
    }
</style>
@endsection
