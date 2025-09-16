<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class CartItem extends Model
{
   protected $fillable = [
        'product_id',
        'product_name',
        'product_price',
        'product_image',
        'selected_colors',
        'selected_sizes',
        'quantity',
    ];

    protected $casts = [
        'selected_colors' => 'array',
        'selected_sizes'  => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
