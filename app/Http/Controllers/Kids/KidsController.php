<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class KidsController extends Controller
{
    public function index(Request $request)
    {
        // Basic RGB map
        $basicColors = [
            'Red' => [255, 0, 0],
            'Green' => [0, 128, 0],
            'Blue' => [0, 0, 255],
            'Yellow' => [255, 255, 0],
            'Black' => [0, 0, 0],
            'White' => [255, 255, 255],
            'Orange' => [255, 165, 0],
            'Purple' => [128, 0, 128],
            'Brown' => [139, 69, 19],
            'Gray' => [128, 128, 128],
        ];

        // Helper: hex to RGB
        $hexToRgb = function (string $hex): ?array {
            $hex = ltrim($hex, '#');
            if (strlen($hex) === 3) {
                $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
            }
            if (strlen($hex) !== 6) return null;
            return [
                hexdec(substr($hex, 0, 2)),
                hexdec(substr($hex, 2, 2)),
                hexdec(substr($hex, 4, 2)),
            ];
        };

        // Helper: find nearest basic color
        $getNearestBasicColor = function (string $hexColor) use ($hexToRgb, $basicColors): ?string {
            $rgb = $hexToRgb($hexColor);
            if (!$rgb) return null;

            $minDistance = PHP_INT_MAX;
            $closestColor = null;

            foreach ($basicColors as $name => $basicRgb) {
                $distance = sqrt(
                    pow($rgb[0] - $basicRgb[0], 2) +
                    pow($rgb[1] - $basicRgb[1], 2) +
                    pow($rgb[2] - $basicRgb[2], 2)
                );
                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestColor = $name;
                }
            }
            return $closestColor;
        };

        // Build base query
        $query = Product::where('category', 'Kids')->orderBy('created_at', 'desc');

        // Size filter
        if ($request->filled('size')) {
            $query->where('sizes', 'LIKE', '%' . $request->size . '%');
        }

        // Subcategory filter
        if ($request->filled('subcategory')) {
            $query->where('subcategory', $request->subcategory);
        }

        // Handle color filtering
        $selectedColor = $request->input('color');
        $availableColorShades = [];

        if ($selectedColor) {
            $allColors = Product::where('category', 'Kids')
                ->pluck('colors')
                ->flatMap(function ($colorString) {
                    return array_map('trim', explode(',', $colorString));
                })->unique();

            $availableColorShades = $allColors->filter(function ($hex) use ($getNearestBasicColor, $selectedColor) {
                return $getNearestBasicColor($hex) === $selectedColor;
            })->values()->all();

            $query->where(function ($q) use ($availableColorShades) {
                foreach ($availableColorShades as $shade) {
                    $q->orWhere('colors', 'LIKE', '%' . $shade . '%');
                }
            });
        }

        // Paginated products
        $products = $query->paginate(9);

        // Attach images
        foreach ($products as $product) {
            $product->images_collection = ProductImage::where('product_id', $product->id)->get();
        }

        // Available basic colors (filtered by size if applied)
        $colorQuery = Product::where('status', 1)->where('category', 'Kids');
        if ($request->filled('size')) {
            $colorQuery->where('sizes', 'LIKE', '%' . $request->size . '%');
        }

        $allColors = $colorQuery->pluck('colors')
            ->flatMap(fn($colors) => array_map('trim', explode(',', $colors)))
            ->unique();

        // Group hex shades by nearest basic color
        $groupedColors = [];
        foreach ($allColors as $hex) {
            $basic = $getNearestBasicColor($hex);
            if ($basic) {
                $groupedColors[$basic][] = $hex;
            }
        }

        // Final color map: [BasicColor => FirstHexShadeForPreview]
        $availableColors = collect($groupedColors)->mapWithKeys(function ($shades, $basic) {
            return [$basic => $shades[0]];
        })->all();

        // ✅ Subcategories
        $subcategories = [
            'Men' => ['Shirts', 'T-Shirts', 'Bottoms', 'Trousers', 'Shoes'],
            'Women' => ['Dresses', 'Tops', 'Shoes'],
            'Kids' => ['Boys', 'Girls'],
            'Accessories' => ['Men', 'Women', 'Bags', 'Jewelry', 'Watches'],
        ];

        return view('kids.index', compact('products', 'availableColors', 'subcategories'));
    }
}
