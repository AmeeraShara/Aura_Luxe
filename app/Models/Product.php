<?php

// app/Models/Product.php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'category', 'price', 'stock_quantity',
        'sizes', 'color', 'description', 'images', 'status'
    ];
}

