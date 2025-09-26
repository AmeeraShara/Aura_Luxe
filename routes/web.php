<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;





Route::get('/', function () {
    return view('auth.register'); // load your floating register/login UI
});

// Registration
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Optional: temporary dashboard
Route::get('/user/dashboard', function () {
    return "<h1>User Dashboard</h1>";
});