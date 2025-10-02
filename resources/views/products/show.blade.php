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
            user-select: none;
        }

        .size-button.selected {
            background-color: #000;
            color: #fff;
            border-color: #000;
        }

        .related-product img {
            height: 160px;
            object-fit: cover;
        }

        .card-body {
            text-align: center;
        }

        .card-body .btn {
            margin: 5px 3px;
            font-size: 0.7rem;
        }

        .icon-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .icon-btn {
            background-color: red;
            border: none;
            color: white;
            padding: 10px;
            font-size: 16px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .icon-btn:hover {
            background-color: darkred;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .product-wrapper {
                display: flex;
                flex-direction: column;
                overflow: visible;
            }

            .product-images,
            .product-details {
                float: none !important;
                width: 100% !important;
                text-align: center;
                margin-bottom: 1.5rem;
            }

            .product-images img.main {
                width: 100%;
                max-width: 300px;
                height: auto;
                margin: 0 auto 1rem;
                display: block;
            }

            .thumbnails {
                display: flex;
                overflow-x: auto;
                justify-content: center;
                gap: 0.5rem;
                padding-bottom: 0.5rem;
            }

            .thumbnails img {
                flex: 0 0 auto;
                width: 70px;
                height: 85px;
                margin: 0;
                border-radius: 6px;
            }

            .color-circle,
            .size-button {
                margin-bottom: 0.5rem;
            }

            form button[type="submit"] {
                width: 100% !important;
                max-width: none !important;
            }

            .mt-16 > div {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 1rem !important;
            }
        }

        @media (max-width: 480px) {
            .product-images img.main {
                max-width: 100%;
                height: auto;
            }

            .thumbnails img {
                width: 60px;
                height: 75px;
            }

            .icon-btn {
                padding: 8px;
                font-size: 14px;
            }
        }
    </style>

    <!-- Product Section -->
    <div class="product-wrapper">

        <!-- LEFT: Images -->
        <div class="product-images">
            @if($images->isNotEmpty())
            <img src="{{ asset($images->first()->path) }}" id="mainImage" class="main mb-4" alt="{{ $product->name }}">
            <div class="thumbnails">
                @foreach($images as $image)
                <img src="{{ asset($image->path) }}" onclick="document.getElementById('mainImage').src=this.src" alt="{{ $product->name }} thumbnail">
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
                    <div class="flex space-x-2 flex-wrap justify-center">
                        @foreach(explode(',', $product->colors) as $color)
                        @php $clr = trim($color); @endphp
                        <span class="color-circle" style="<?php echo 'background-color:' . $color; ?>;" data-color="<?php echo $color; ?>"></span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Sizes -->
                @if($product->sizes)
                <div class="mt-6">
                    <p class="font-medium mb-2">Sizes:</p>
                    <div class="flex space-x-2 flex-wrap justify-center">
                        @foreach(explode(',', $product->sizes) as $size)
                        <span class="size-button" data-size="{{ trim($size) }}">{{ trim($size) }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                <br>

                <!-- Quantity -->
                <div class="flex items-center mb-4 mt-6 justify-center">
                    <label class="mr-3 font-medium" for="quantity">Qty:</label>
                    <input id="quantity" type="number" name="quantity" value="1" min="1" class="w-20 border px-2 py-1 rounded">
                </div>

                <!-- Submit -->
<!-- If logged in -->
@auth
<form method="POST" action="{{ route('cart.add', $product->id) }}" class="mt-8">
    @csrf
    <!-- (colors, sizes, quantity inputs remain same) -->
    <button type="submit"
        class="w-full md:w-80 text-base font-medium px-10 py-2 rounded-lg shadow-md">
        🛒 <span>Add to Cart</span>
    </button>
</form>
@endauth

<!-- If not logged in -->
@guest
    <button type="button" id="openLoginFromCart"
        class="w-full md:w-80 text-base font-medium px-10 py-2 rounded-lg shadow-md">
        🛒 <span>Add to Cart</span>
    </button>
@endguest

            </form>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-16 clear-both">
        <h2 class="text-xl font-bold mb-6">Related Products</h2>
        <div style="display: grid; grid-template-columns: repeat(6, minmax(0, 1fr)); gap: 1.5rem;">
            @foreach($relatedProducts as $related)
            <div class="border p-2 rounded shadow hover:shadow-lg transition related-product relative">

                <img src="{{ $related->first_image ? asset($related->first_image) : asset('uploads/products/default.jpg') }}"
                    alt="{{ $related->name }}"
                    class="w-full rounded">

                <div class="card-body">
                    <div class="icon-group">
                        <button class="icon-btn" aria-label="Add to Wishlist"><i class="fa fa-heart"></i></button>
                        <a href="{{ route('products.show', $related->id) }}" class="icon-btn" aria-label="View Product">
                            <i class="fa fa-eye"></i>
                        </a>
                    </div>
                    <h5 class="card-title">{{ $related->name }}</h5>
                    <p class="card-text text-danger fw-bold">
                        LKR {{ number_format($related->price, 2) }}
                    </p>
                </div>

            </div>
            @endforeach
        </div>
    </div>

</div>

<script>
    
document.addEventListener("DOMContentLoaded", () => {
    const openLoginFromCart = document.getElementById("openLoginFromCart");
    const loginBox = document.getElementById("loginBox");

    if (openLoginFromCart) {
        openLoginFromCart.addEventListener("click", (e) => {
            e.preventDefault();
            loginBox.style.display = "block";
        });
    }
});

    document.addEventListener('DOMContentLoaded', () => {
        // Toggle color selection
        document.querySelectorAll('.color-circle').forEach(circle => {
            circle.addEventListener('click', function() {
                this.classList.toggle('selected');
            });
        });

        // Toggle size selection
        document.querySelectorAll('.size-button').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('selected');
            });
        });

        // On form submit, add hidden inputs for selected colors and sizes
        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            // Remove existing hidden inputs if any
            form.querySelectorAll('input[name="selected_colors[]"], input[name="selected_sizes[]"]').forEach(input => input.remove());

            // Append hidden inputs for selected colors
            document.querySelectorAll('.color-circle.selected').forEach(circle => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_colors[]';
                input.value = circle.dataset.color;
                form.appendChild(input);
            });

            // Append hidden inputs for selected sizes
            document.querySelectorAll('.size-button.selected').forEach(button => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_sizes[]';
                input.value = button.dataset.size;
                form.appendChild(input);
            });
        });
    });
</script>
@endsection
