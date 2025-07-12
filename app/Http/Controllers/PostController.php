<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Tampilkan home + daftar postingan

    public function index()
    {
        $posts = Post::where('is_archived', false)->latest()->get();
        return view('home', compact('posts'));
    }

    // Simpan postingan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $data['user_id'] = Auth::id(); // ✅ Tambahkan relasi ke user yang login

        Post::create($data);

        return redirect()->route('home')->with('success', 'Postingan berhasil dibuat.');
    }

    /**
     * Tampilkan form edit untuk sebuah post.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (Auth::user()->role !== 'admin' && $post->user_id !== Auth::id()) {
            abort(403, 'Tidak memiliki izin.');
        }

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required',
        ]);

        Post::findOrFail($id)->update($data);
        if (!auth()->user()->is_admin && $post->user_id !== auth()->id()) {
            abort(403);
        }

        // Kembalikan JSON success
        return response()->json([
            'success' => true,
            'post' => Post::find($id),
        ]);
    }

    // Untuk menghapus post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (!auth()->user()->is_admin && $post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Postingan berhasil dihapus.');
    }

    // Untuk mengarsip post
    public function archive($id)
    {
        $post = Post::findOrFail($id);

        // Pastikan hanya user pemilik yang bisa arsip
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->update(['is_archived' => true]);

        return redirect()->back()->with('success', 'Postingan berhasil diarsipkan.');
    }

    public function unarchive($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->update(['is_archived' => false]);

        return redirect()->back()->with('success', 'Postingan berhasil dikembalikan.');
    }
}
