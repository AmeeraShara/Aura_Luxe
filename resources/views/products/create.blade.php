<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-100 h-screen p-4">
        <h2 class="text-xl font-bold mb-6">Aura Luxe</h2>
        <nav class="space-y-2">
            <a href="#" class="block px-3 py-2 rounded bg-gray-200">Dashboard</a>
            <a href="{{ route('products.create') }}" class="block px-3 py-2 rounded bg-gray-300 font-semibold">Products</a>
            <a href="#" class="block px-3 py-2 rounded bg-gray-200">Orders</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-2xl font-semibold mb-6">Add New Product</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow">
            @csrf

            <!-- Product Name + Category -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Product Name</label>
                    <input type="text" name="name" class="w-full border rounded-lg p-2" placeholder="Enter product name">
                </div>
                <div>
                    <label class="block font-medium">Product Category</label>
                    <input type="text" name="category" class="w-full border rounded-lg p-2" placeholder="Enter category">
                </div>
            </div>

            <!-- Price + Stock -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Price</label>
                    <input type="number" step="0.01" name="price" class="w-full border rounded-lg p-2" placeholder="LKR 0.00">
                </div>
                <div>
                    <label class="block font-medium">Stock Quantity</label>
                    <input type="number" name="stock_quantity" class="w-full border rounded-lg p-2" placeholder="0">
                </div>
            </div>

            <!-- Sizes + Color -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Size Options</label>
                    <div class="flex gap-4 mt-2">
                        @foreach (['S','M','L','XL','XXL','XXXL'] as $size)
                            <label class="flex items-center gap-1">
                                <input type="checkbox" name="sizes[]" value="{{ $size }}">
                                {{ $size }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label class="block font-medium">Color Option</label>
                    <input type="color" name="color" value="#000000" class="w-16 h-10 border rounded-lg">
                </div>
            </div>

            <!-- Upload Images -->
            <div>
                <label class="block font-medium">Upload Images</label>
                <div class="border-2 border-dashed rounded-lg p-6 text-center">
                    <input type="file" name="images[]" multiple class="hidden" id="imagesInput">
                    <label for="imagesInput" class="cursor-pointer">
                        <div class="text-gray-600">Drag & Drop product images here or click to upload</div>
                        <small class="text-gray-400">Max 5 files, .png, .jpeg, .jpg</small>
                    </label>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded-lg p-2" rows="4" placeholder="Provide a detailed product description"></textarea>
            </div>

            <!-- Status Toggle -->
            <div class="flex items-center justify-between border rounded-lg p-4">
                <div>
                    <label class="block font-medium">Product Status</label>
                    <span class="text-gray-500 text-sm">Set product to active. Visible on storefront</span>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="status" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600"></div>
                    <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-5"></div>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4">
                <button type="reset" class="px-6 py-2 border rounded-lg">Reset / Clear Form</button>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg">Save Product</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
