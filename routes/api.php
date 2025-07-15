<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostApiController;

Route::get('/posts', [PostApiController::class, 'index']); // Untuk list-post

// Debug routes opsional
Route::get('/check', fn() => response()->json(['status' => 'API working!']));
Route::get('/debug', fn() => response()->json(['message' => 'API route is working!']));


