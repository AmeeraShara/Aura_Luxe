<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\NewArrivalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenController;
use App\Http\Controllers\WomenController;
use App\Http\Controllers\KidsController;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Accessories\AccessoriesController;


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
Route::get('/', [HomeController::class, 'index'])->name('front');


//New Arrival Page
Route::prefix('newarrival')->group(function () {
    Route::get('/', [NewArrivalController::class, 'index'])->name('newarrival.index');
    Route::get('/show/{id}', [NewArrivalController::class, 'show'])->name('newarrival.show');
});

//Men page
Route::get('/men', [MenController::class, 'index'])->name('men.index');
Route::get('/men/{id}', [MenController::class, 'show'])->name('men.show');

//Women page
Route::get('/women', [WomenController::class, 'index'])->name('women.index');
Route::get('/women/{id}', [WomenController::class, 'show'])->name('women.show');

//Kids Page
Route::get('/kids', [KidsController::class, 'index'])->name('kids.index');

//Sale
Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');

//Accessories
Route::get('/accessories', [AccessoriesController::class, 'index'])->name('accessories.index');
