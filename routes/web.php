<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PostController::class, 'index'])->name('home');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| User Routes (Hanya yang sudah login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Post CRUD untuk user (hanya miliknya sendiri)
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{id}/archive', [PostController::class, 'archive'])->name('posts.archive');

    // Profile & export
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::get('/profile/export/posts/pdf', [ProfileController::class, 'exportPostsPdf'])->name('profile.export.posts.pdf');
    Route::get('/profile/export/posts/csv', [ProfileController::class, 'exportPostsCsv'])->name('profile.export.posts.csv');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/export/posts/pdf', [AdminController::class, 'exportAllPostsPdf'])->name('admin.export.posts.pdf');
    Route::get('/admin/export/posts/csv', [AdminController::class, 'exportAllPostsCsv'])->name('admin.export.posts.csv');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/posts/{id}/archive', [PostController::class, 'archive'])->name('posts.archive');
    Route::post('/posts/{id}/unarchive', [PostController::class, 'unarchive'])->name('posts.unarchive');
});
