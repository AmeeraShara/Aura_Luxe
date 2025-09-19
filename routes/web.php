<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Contact\ContactController;
 
Route::get('/', function () {
    return view('front');
});

//Create Product 
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

//Cart
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/update/{id}', [CartController::class, 'update'])->name('cart.update');
});

//Contact
Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/', [ContactController::class, 'store'])->name('contact.store');
});

//Front page
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('front');


use App\Http\Controllers\NewArrivalController;

Route::prefix('newarrival')->group(function () {
    Route::get('/', [NewArrivalController::class, 'index'])->name('newarrival.index');
    Route::get('/show/{id}', [NewArrivalController::class, 'show'])->name('newarrival.show');
});
