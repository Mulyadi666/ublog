<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostApiController extends Controller
{
    // Ambil semua postingan
    public function index()
    {
        return response()->json(Post::latest()->get(), 200);
    }

    // Simpan postingan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'content' => 'required|string',
        ]);

        $post = Post::create($validated);

        return response()->json([
            'message' => 'Postingan berhasil disimpan',
            'data' => $post
        ], 201);
    }
}
