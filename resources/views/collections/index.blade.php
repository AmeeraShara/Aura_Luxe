@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 ">Our Collections</h2>

    <div class="row g-4 justify-content-center">

        @foreach($collections as $collection)
            <div class="col-md-4">
                <a href="{{ route($collection['route']) }}" class="text-decoration-none">
                    <div class="card collection-card h-100 shadow-sm">
                        <img src="{{ $collection['image'] }}" class="card-img-top" alt="{{ $collection['name'] }}">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $collection['name'] }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

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
        height: 550px;
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
