<?php

namespace App\Http\Controllers\NewArrival;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
    use Illuminate\Support\Collection;

class NewArrivalController extends Controller
{

public function index(Request $request)
{
    // Basic color map for matching
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

    // Helper: Convert hex to RGB
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

    // Helper: Find nearest basic color
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

    // Start query
    $query = Product::orderBy('created_at', 'desc');

    // Apply size filter
    if ($request->filled('size')) {
        $query->where('sizes', 'like', "%{$request->size}%");
    }

    // Handle color filter by matching selected basic color to all its shades
    $colorFilter = $request->input('color');
    $availableColorShades = [];

    if ($colorFilter) {
        // Find all shades matching the selected basic color
        $allColors = Product::pluck('colors')->flatMap(function ($colorString) {
            return array_map('trim', explode(',', $colorString));
        })->unique();

        $availableColorShades = $allColors->filter(function ($hex) use ($getNearestBasicColor, $colorFilter) {
            return $getNearestBasicColor($hex) === $colorFilter;
        })->values()->all();

        // Filter products by matching hex codes
        $query->where(function ($q) use ($availableColorShades) {
            foreach ($availableColorShades as $shade) {
                $q->orWhere('colors', 'like', "%{$shade}%");
            }
        });
    }

    // Fetch products
    $products = $query->paginate(12);

    // Attach images
    foreach ($products as $product) {
        $product->images_collection = ProductImage::where('product_id', $product->id)->get();
    }

    // Build available basic colors for filter
    $colorQuery = Product::query();
    if ($request->filled('size')) {
        $colorQuery->where('sizes', 'like', "%{$request->size}%");
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

    // For UI: show basic color and a sample shade (first in list)
    $availableColors = collect($groupedColors)->mapWithKeys(function ($shades, $basic) {
        return [$basic => $shades[0]]; // first shade for preview
    })->all();

    return view('newarrival.index', compact('products', 'availableColors'));
}
}