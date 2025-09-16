@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <style>
        .product-wrapper {
            overflow: hidden;
        }

        .product-images {
            float: left;
            width: 45%;
            text-align: center;
        }

        .product-details {
            float: right;
            width: 50%;
        }

        .product-images img.main {
            width: 400px;
            height: 500px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .thumbnails img {
            width: 90px;
            height: 110px;
            object-fit: cover;
            margin: 5px;
            border-radius: 6px;
            cursor: pointer;
            border: 1px solid #ddd;
        }

        .thumbnails img:hover {
            border-color: #000;
        }

        .color-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #ddd;
            cursor: pointer;
            transition: 0.2s;
            display: inline-block;
        }

        .color-circle.selected {
            border: 2px solid #000;
        }

        .size-button {
            border: 1px solid #ddd;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .size-button.selected {
            background-color: #000;
            color: #fff;
            border-color: #000;
        }
    </style>

    <!-- Product Section -->
    <div class="product-wrapper">

        <!-- LEFT: Images -->
        <div class="product-images">
            @if($images->isNotEmpty())
            <img src="{{ asset($images->first()->path) }}" id="mainImage" class="main mb-4">
            <div class="thumbnails">
                @foreach($images as $image)
                <img src="{{ asset($image->path) }}" onclick="document.getElementById('mainImage').src=this.src">
                @endforeach
            </div>
            @endif
        </div>

        <!-- RIGHT: Product Details -->
        <div class="product-details">
            <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
            <p class="text-gray-600 mt-1">⭐ 4.8 (384 reviews)</p>
            <p class="text-2xl font-semibold mt-3">LKR {{ number_format($product->price, 2) }}</p>

            <!-- Add to Cart -->
            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mt-8">
                @csrf

                <!-- Colors -->
                @if($product->colors)
                <div class="mt-6">
                    <p class="font-medium mb-2">Colors:</p>
                    <div class="flex space-x-2 flex-wrap">
                        @foreach(explode(',', $product->colors) as $color)
                        @php $clr = trim($color); @endphp
                        <label>
                            <input type="checkbox" name="selected_colors[]" value="{{ $clr }}" class="hidden">
                            <span class="color-circle" style="<?php echo 'background-color:' . $clr; ?>;" data-color="<?php echo $clr; ?>"></span> </label>
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
                        <label>
                            <input type="checkbox" name="selected_sizes[]" value="{{ trim($size) }}" class="hidden">
                            <span class="size-button">{{ trim($size) }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Quantity -->
                <div class="flex items-center mb-4 mt-6">
                    <label class="mr-3 font-medium">Qty:</label>
                    <input type="number" name="quantity" value="1" min="1" class="w-20 border px-2 py-1 rounded">
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full md:w-80 text-base font-medium px-10 py-2 rounded-lg shadow-md 
                           flex items-center justify-center gap-2 focus:outline-none focus:ring-0 transition-colors duration-300 ease-in-out"
                    style="background-color: white !important; color: black !important; border: none !important;"
                    onmouseover="this.style.backgroundColor='black'; this.style.color='white';"
                    onmouseout="this.style.backgroundColor='white'; this.style.color='black';">
                    🛒 <span>Add to Cart</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-16 clear-both">
        <h2 class="text-xl font-bold mb-6">Related Products</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            <div class="border p-2 rounded shadow hover:shadow-lg transition">
                @if($related->images->isNotEmpty())
                <img src="{{ asset($related->images->first()->path) }}" class="w-full h-64 object-cover rounded">
                @else
                <img src="{{ asset('uploads/products/default.jpg') }}" class="w-full h-64 object-cover rounded">
                @endif
                <h3 class="mt-2 font-semibold">{{ $related->name }}</h3>
                <p class="text-gray-600">LKR {{ number_format($related->price, 2) }}</p>
            </div>
            @endforeach
        </div>
    </div>

</div>

<script>
    // Toggle color selection
    document.querySelectorAll('.color-circle').forEach(circle => {
        circle.addEventListener('click', function() {
            this.classList.toggle('selected');
            const checkbox = this.previousElementSibling;
            checkbox.checked = !checkbox.checked;
        });
    });

    // Toggle size selection
    document.querySelectorAll('.size-button').forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('selected');
            const checkbox = this.previousElementSibling;
            checkbox.checked = !checkbox.checked;
        });
    });
</script>
@endsection