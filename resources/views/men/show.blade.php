@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <!-- Product Images -->
        <div class="col-md-6">
            @foreach($images as $img)
                <img src="{{ asset($img->path) }}" class="img-fluid mb-3">
            @endforeach
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">LKR {{ number_format($product->price, 2) }}</p>
            <p>{{ $product->description }}</p>
            <button class="btn btn-success">Add to Cart</button>
        </div>
    </div>

    <!-- Related Products -->
    <h4 class="mt-5">You may also like</h4>
    <div class="row">
        @foreach($relatedProducts as $rel)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset(optional($rel->images->first())->path ?? 'images/no-image.png') }}" class="card-img-top">
                    <div class="card-body">
                        <h6>{{ $rel->name }}</h6>
                        <a href="{{ route('men.show', $rel->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
