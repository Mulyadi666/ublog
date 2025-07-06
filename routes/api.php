<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Models\Post;

Route::apiResource('posts', PostController::class);
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);

Route::post('/posts', function (Request $request) {
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'content' => 'required',
    ]);

    return Post::create($request->all());
});

Route::get('/posts', function () {
    return Post::all();
});

Route::get('/check', function () {
    return response()->json(['status' => 'API working!']);
});

Route::get('/debug', function () {
    return response()->json(['message' => 'API route is working!']);
});

