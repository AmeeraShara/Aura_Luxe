<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'category', 'subcategory',  'price', 'stock_quantity',
        'sizes', 'colors', 'description', 'status'
    ];

   public function images()
{
    return $this->hasMany(ProductImage::class, 'product_id');
}

}
