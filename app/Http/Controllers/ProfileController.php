<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $userId = Auth::id();

        $sharedPosts = auth()->user()->posts()->where('is_archived', false)->get();
        $archivedPosts = auth()->user()->posts()->where('is_archived', true)->get();

        return view('profile', compact('sharedPosts', 'archivedPosts'));
    }

    public function exportPostsPdf()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $posts = Post::with('user')->latest()->get();
        } else {
            $posts = Post::where('user_id', $user->id)->latest()->get();
        }

        if ($posts->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada postingan untuk diekspor.');
        }

        $pdf = Pdf::loadView('posts_pdf', compact('posts'))->setPaper('a4', 'portrait');
        return $pdf->download('list-postingan-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportPostsCsv()
    {
        $posts = \App\Models\Post::where('user_id', \Auth::id())->orderBy('created_at', 'desc')->get();

        $filename = 'postingan-saya-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($posts) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xef) . chr(0xbb) . chr(0xbf)); // UTF-8 BOM

            // Header kolom
            fputcsv($file, ['No', 'Judul', 'Author', 'Konten', 'Tanggal', 'Status']);

            $no = 1;
            foreach ($posts as $post) {
                fputcsv($file, [$no++, $post->title, $post->author, $post->content, $post->created_at->format('d/m/Y H:i'), $post->is_archived ? 'Arsip' : 'Publik']);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
