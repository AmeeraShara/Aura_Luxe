<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <body class="bg-gray-50 h-screen overflow-hidden">

    <div class="flex flex-col md:flex-row h-full">
        <!-- Sidebar -->
        <aside class="w-full md:w-52 bg-gray-100 p-3 overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Aura Luxe</h2>
            <nav class="space-y-2 text-sm">
                <a href="#" class="block px-3 py-2 rounded bg-gray-200">Dashboard</a>
                <a href="{{ route('products.create') }}" class="block px-3 py-2 rounded bg-gray-300 font-semibold">Products</a>
                <a href="#" class="block px-3 py-2 rounded bg-gray-200">Orders</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-3 overflow-y-auto">
            <div class="max-w-6xl mx-auto w-full h-full">
                <h1 class="text-lg font-semibold mb-3">Add New Product</h1>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4 bg-white p-4 rounded-lg shadow text-sm h-full overflow-y-auto">
                    @csrf

                    <!-- Product Name + Category + Subcategory -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <div>
                            <label class="block font-medium">Product Name</label>
                            <input type="text" name="name" class="w-full border rounded p-1.5" placeholder="Enter product name">
                        </div>
                        <div>
                            <label class="block font-medium">Category</label>
                            <select id="category" name="category" class="w-full border rounded p-1.5">
                                <option value="">-- Select Category --</option>
                                <option value="Men">MEN</option>
                                <option value="Women">WOMEN</option>
                                <option value="Kids">KIDS</option>
                                <option value="Sale">SALE</option>
                                <option value="Accessories">ACCESSORIES</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium">Subcategory</label>
                            <select id="subcategory" name="subcategory" class="w-full border rounded p-1.5">
                                <option value="">-- Select Subcategory --</option>
                            </select>
                        </div>
                    </div>

                    <!-- Price + Stock -->
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-medium">Price</label>
                            <input type="number" step="0.01" name="price" class="w-full border rounded p-1.5" placeholder="LKR 0.00">
                        </div>
                        <div>
                            <label class="block font-medium">Stock</label>
                            <input type="number" name="stock_quantity" class="w-full border rounded p-1.5" placeholder="0">
                        </div>
                    </div>

                    <!-- Sizes + Colors -->
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-medium">Sizes</label>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach (['XS','S','M','L','XL','XXL','XXXL'] as $size)
                                    <label class="flex items-center gap-1">
                                        <input type="checkbox" name="sizes[]" value="{{ $size }}">
                                        {{ $size }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <label class="block font-medium">Colors</label>
                            <div id="colorContainer" class="flex flex-wrap gap-2 mt-1"></div>
                            <button type="button" id="addColorBtn"
                                class="mt-1 px-2 py-1 text-xs bg-gray-200 rounded hover:bg-gray-300">+ Add Color</button>
                        </div>
                    </div>

                    <!-- Images -->
                    <div>
                        <label class="block font-medium">Upload Images</label>
                        <div id="dropZone"
                            class="border-2 border-dashed rounded p-4 text-center text-sm cursor-pointer">
                            <input type="file" name="images[]" multiple class="hidden" id="imagesInput"
                                accept=".png,.jpg,.jpeg">
                            <label for="imagesInput" class="cursor-pointer block text-gray-600">
                                Drag & Drop or click to upload
                            </label>
                            <small class="text-gray-400">Max 5 files</small>
                        </div>
                        <div id="previewContainer" class="flex flex-wrap gap-2 mt-2"></div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block font-medium">Description</label>
                        <textarea name="description" class="w-full border rounded p-2 text-sm" rows="2"
                            placeholder="Product description"></textarea>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center justify-between border rounded p-2">
                        <div>
                            <label class="block font-medium">Status</label>
                            <span class="text-gray-500 text-xs">Active = Visible</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="status" class="sr-only peer" checked>
                            <div class="w-10 h-5 bg-gray-200 rounded-full peer peer-checked:bg-blue-600"></div>
                            <div class="absolute left-1 top-1 bg-white w-3.5 h-3.5 rounded-full transition peer-checked:translate-x-5"></div>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="reset" class="px-4 py-1 border rounded">Reset</button>
                        <button type="submit" class="px-4 py-1 bg-blue-600 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script>
        // Category -> Subcategory mapping
        const categoryDropdown = document.getElementById("category");
        const subcategoryDropdown = document.getElementById("subcategory");

        const subcategories = {
            "Men": ["Shirts", "T-Shirts", "Bottoms", "Trousers", "Shoes"],
            "Women": ["Dresses", "Tops", "Shoes"],
            "Kids": ["Boys", "Girls"],
            "Accessories": ["Men", "Women", "Bags", "Jewelry", "Watches"]
        };

        categoryDropdown.addEventListener("change", function () {
            const selectedCategory = this.value;
            subcategoryDropdown.innerHTML =
                '<option value="">-- Select Subcategory --</option>';

            if (subcategories[selectedCategory]) {
                subcategories[selectedCategory].forEach(sub => {
                    const option = document.createElement("option");
                    option.value = sub;
                    option.textContent = sub;
                    subcategoryDropdown.appendChild(option);
                });
            }
        });

        // Image upload & preview
        const input = document.getElementById("imagesInput");
        const previewContainer = document.getElementById("previewContainer");
        const dropZone = document.getElementById("dropZone");
        let selectedFiles = [];

        function handleFiles(files) {
            const newFiles = Array.from(files);
            selectedFiles = [...selectedFiles, ...newFiles].slice(0, 5);

            previewContainer.innerHTML = "";
            selectedFiles.forEach(file => {
                if (!file.type.startsWith("image/")) return;
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("w-24", "h-24", "object-cover", "rounded-lg", "shadow");
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }

        input.addEventListener("change", () => handleFiles(input.files));

        dropZone.addEventListener("dragover", e => {
            e.preventDefault();
            dropZone.classList.add("bg-gray-100");
        });

        dropZone.addEventListener("dragleave", () => dropZone.classList.remove("bg-gray-100"));

        dropZone.addEventListener("drop", e => {
            e.preventDefault();
            dropZone.classList.remove("bg-gray-100");
            handleFiles(e.dataTransfer.files);
        });

        document.querySelector("form").addEventListener("submit", e => {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        });

        // Dynamic color inputs
        const colorContainer = document.getElementById("colorContainer");
        const addColorBtn = document.getElementById("addColorBtn");

        function createColorInput(value = "#000000") {
            const wrapper = document.createElement("div");
            wrapper.classList.add("flex", "items-center", "gap-2");

            const input = document.createElement("input");
            input.type = "color";
            input.name = "colors[]";
            input.value = value;
            input.classList.add("w-16", "h-10", "border", "rounded-lg");

            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.textContent = "✖";
            removeBtn.classList.add("text-red-500", "hover:text-red-700");
            removeBtn.onclick = () => wrapper.remove();

            wrapper.appendChild(input);
            wrapper.appendChild(removeBtn);

            return wrapper;
        }

        addColorBtn.addEventListener("click", () => {
            colorContainer.appendChild(createColorInput());
        });

        window.addEventListener("DOMContentLoaded", () => {
            colorContainer.appendChild(createColorInput());
        });

        // Custom reset handler
        document.querySelector('button[type="reset"]').addEventListener('click', () => {
            selectedFiles = [];
            previewContainer.innerHTML = "";
            input.value = "";
            colorContainer.innerHTML = "";
            colorContainer.appendChild(createColorInput());
            categoryDropdown.value = "";
            subcategoryDropdown.innerHTML = '<option value="">-- Select Subcategory --</option>';
            document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            document.querySelectorAll('input[type="text"], input[type="number"], textarea').forEach(el => el.value = '');
            document.querySelector('input[name="status"]').checked = true;
        });
    </script>

</body>

</html>
