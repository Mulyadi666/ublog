<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

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

