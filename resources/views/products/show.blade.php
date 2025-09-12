@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <!-- Product Section -->
    <div class="grid grid-cols-1 md:grid-cols-[400px_1fr] gap-8 items-start">
        
        <!-- LEFT: Images -->
        <div>
            @if($images->isNotEmpty())
                <!-- Main Image -->
                <img src="{{ asset($images->first()->path) }}"
                     id="mainImage"
                     class="object-cover rounded shadow mb-3"
                     style="width:350px; height:350px;">

                <!-- Thumbnails -->
                <div class="flex space-x-2 mt-2">
                    @foreach($images as $image)
                        <img src="{{ asset($image->path) }}"
                             class="object-cover rounded cursor-pointer border hover:border-black"
                             style="width:80px; height:80px;"
                             onclick="document.getElementById('mainImage').src=this.src">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- RIGHT: Product Details -->
        <div>
            <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
            <p class="text-gray-600 mt-1">⭐ 4.8 (384 reviews)</p>
            <p class="text-2xl font-semibold mt-3">LKR {{ number_format($product->price, 2) }}</p>

            <!-- Colors -->
            @if($product->colors)
                <div class="mt-6">
                    <p class="font-medium mb-2">Colors:</p>
                    <div class="flex space-x-2">
                        @foreach(explode(',', $product->colors) as $color)
                            <span class="w-8 h-8 rounded-full border cursor-pointer"
                                  style="background-color: {{ $color }}"></span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Sizes -->
            @if($product->sizes)
                <div class="mt-6">
                    <p class="font-medium mb-2">Sizes:</p>
                    <div class="flex space-x-2 flex-wrap">
                        @foreach(explode(',', $product->sizes) as $size)
                            <button class="px-4 py-2 border rounded hover:bg-gray-100">{{ $size }}</button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Add to Cart -->
            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mt-8 flex items-center">
                @csrf
                <label class="mr-3">Qty:</label>
                <input type="number" name="quantity" value="1" min="1" class="w-20 border px-2 py-1">

                <button type="submit"
                        class="bg-black text-white px-6 py-2 rounded ml-4 hover:bg-gray-800 transition">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-16">
        <h2 class="text-xl font-bold mb-6">Related Products</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
                <div class="border p-2 rounded shadow hover:shadow-lg transition">
                    @php
                        $relatedImage = $related->images->first();
                    @endphp
                    <img src="{{ asset($relatedImage->path ?? 'default.jpg') }}"
                         class="w-full h-64 object-cover rounded">
                    <h3 class="mt-2 font-semibold">{{ $related->name }}</h3>
                    <p class="text-gray-600">LKR {{ number_format($related->price, 2) }}</p>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
