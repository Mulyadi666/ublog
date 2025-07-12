@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

    {{-- Export --}}
    <div class="mb-4 space-x-2">
        <a href="{{ route('admin.export.posts.pdf') }}"
           class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Export PDF</a>
        <a href="{{ route('admin.export.posts.csv') }}"
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Export CSV</a>
    </div>

    {{-- Table Postingan --}}
    <h2 class="text-xl font-semibold mb-2">Semua Postingan</h2>
    <div class="overflow-x-auto mb-6">
        <table class="min-w-full border">
            <thead class="bg-gray-100 text-sm font-bold">
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Nama Akun</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Author</th>
                    <th class="border px-4 py-2">Judul</th>
                    <th class="border px-4 py-2">Isi</th>
                    <th class="border px-4 py-2">Tanggal</th>
                    <th class="border px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $i => $post)
                <tr>
                    <td class="border px-4 py-1">{{ $i + 1 }}</td>
                    <td class="border px-4 py-1">{{ $post->user->name }}</td>
                    <td class="border px-4 py-1">{{ $post->user->email }}</td>
                    <td class="border px-4 py-1">{{ $post->author }}</td>
                    <td class="border px-4 py-1">{{ $post->title }}</td>
                    <td class="border px-4 py-1">{{ $post->content }}</td>
                    <td class="border px-4 py-1">{{ $post->created_at->format('d M Y') }}</td>
                    <td class="border px-4 py-1">{{ $post->is_archived ? 'Arsip' : 'Publik' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Table Users --}}
    <h2 class="text-xl font-semibold mb-2">Semua Akun Terdaftar</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border">
            <thead class="bg-gray-100 text-sm font-bold">
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $i => $user)
                <tr>
                    <td class="border px-4 py-1">{{ $i + 1 }}</td>
                    <td class="border px-4 py-1">{{ $user->name }}</td>
                    <td class="border px-4 py-1">{{ $user->email }}</td>
                    <td class="border px-4 py-1">
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
