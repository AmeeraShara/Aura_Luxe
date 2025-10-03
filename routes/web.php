<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\NewArrival\NewArrivalController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Men\MenController;
use App\Http\Controllers\Women\WomenController;
use App\Http\Controllers\Kids\KidsController;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Accessories\AccessoriesController;
use App\Http\Controllers\Collections\CollectionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\NewsletterController;



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

//Collections Page 
Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');

//Size guide 
Route::view('/size-guide', 'size-guide.index')->name('size-guide.index');

//FAQ
Route::get('/faq', function () {return view('faq');})->name('faq.index');


// LOGIN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// REGISTER
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

//Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

//Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
