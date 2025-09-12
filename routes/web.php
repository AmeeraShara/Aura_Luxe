<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

use App\Http\Controllers\ProductController;

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

use App\Http\Controllers\CartController;

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
