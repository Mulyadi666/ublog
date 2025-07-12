<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function dashboard()
    {
        $posts = Post::with('user')->latest()->get();
        $users = User::latest()->get();

        return view('admin.dashboard', compact('posts', 'users'));
    }

    public function deleteUser($id)
    {
        if (auth()->id() == $id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        User::findOrFail($id)->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }

    public function exportAllPostsCsv()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();

        $filename = 'semua-postingan-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($posts) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, ['No', 'Nama Akun', 'Email', 'Author', 'Judul', 'Isi', 'Tanggal Dibuat', 'Status']);

            $no = 1;
            foreach ($posts as $post) {
                fputcsv($file, [
                    $no++,
                    $post->user->name ?? '-',
                    $post->user->email ?? '-',
                    $post->author,
                    $post->title,
                    $post->content,
                    $post->created_at->format('d/m/Y H:i'),
                    $post->is_archived ? 'Arsip' : 'Publik'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportAllPostsPdf()
    {
        $posts = Post::with('user')->get();

        $pdf = Pdf::loadView('admin_posts_pdf', compact('posts'));
        return $pdf->download('Semua Postingan-' . date('Y-m-d') . '.pdf');
    }
}
