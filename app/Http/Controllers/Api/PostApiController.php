<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
   public function index()
    {
        $posts = Post::where('is_archived', false)->latest()->get(['id', 'title', 'author', 'content', 'created_at', 'user_id']);
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $data['user_id'] = auth()->id();
        $post = Post::create($data);

        return response()->json($post, 201);
    }
}
