<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Tampilkan home + daftar postingan
    public function index()
    {
        $posts = Post::latest()->get();    // ambil semua posting terbaru
    return view('home', compact('posts'));
    }

    // Simpan postingan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'author'  => 'required|string|max:255',
            'content' => 'required',
        ]);

        Post::create($data);

        return redirect()->route('home')->with('success','Postingan berhasil dibuat.');
    }

     /**
     * Tampilkan form edit untuk sebuah post.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    // Proses update
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'author'  => 'required|string|max:255',
            'content' => 'required',
        ]);

        Post::findOrFail($id)->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Postingan berhasil diupdate',
            'post'    => $data
        ]);
    }

    
        // Untuk menghapus post
        public function destroy($id)
        {
            $post = Post::findOrFail($id);
            $post->delete();
    
            return redirect()->route('home')->with('success', 'Postingan berhasil dihapus.');
        }
    
        // Untuk mengarsip post
        public function archive($id)
        {
            $post = Post::findOrFail($id);
            $post->update(['archived_at' => now()]);
    
            return redirect()->route('home')->with('success', 'Postingan berhasil diarsip.');
            }
}
