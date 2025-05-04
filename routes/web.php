<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('auth.login');
});
// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout (bisa dipanggil dari form/button POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Proteksi halaman dashboard
Route::get('/dashboard', function(){
    return view('dashboard');
})->middleware('auth');