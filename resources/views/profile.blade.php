@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Profil Pengguna</h2>

            <div class="mb-6">
                <p><span class="font-semibold">Nama:</span> {{ auth()->user()->name }}</p>
                <p><span class="font-semibold">Email:</span> {{ auth()->user()->email }}</p>
                <p><span class="font-semibold">Bergabung Sejak:</span> {{ auth()->user()->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex gap-4 mb-4">
                <form action="{{ route('profile.export.posts.pdf') }}" method="GET">
                    <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Export PDF
                    </button>
                </form>
                <form action="{{ route('profile.export.posts.csv') }}" method="GET">
                    <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Export Excel
                    </button>
                </form>
            </div>

            {{-- Postingan Dibagikan --}}
            <div class="border-t pt-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Postingan Dibagikan</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white">
                                <th class="py-2 px-4 text-left">Judul</th>
                                <th class="py-2 px-4 text-left">Konten</th>
                                <th class="py-2 px-4 text-left">Tanggal</th>
                                <th class="py-2 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sharedPosts ?? [] as $post)
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <td class="py-2 px-4">{{ $post->title }}</td>
                                    <td class="py-2 px-4">{{ $post->content }}</td>
                                    <td class="py-2 px-4">{{ $post->created_at->format('d M Y') }}</td>
                                    <td class="py-2 px-4 space-x-2">
                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                        <form action="{{ route('posts.archive', $post) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="text-yellow-600 hover:underline">Arsipkan</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-2 px-4 text-center text-gray-500">Tidak ada postingan
                                        dibagikan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Postingan Diarsipkan --}}
            <div class="border-t pt-4 mt-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Postingan Diarsipkan</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white">
                                <th class="py-2 px-4 text-left">Judul</th>
                                <th class="py-2 px-4 text-left">Konten</th>
                                <th class="py-2 px-4 text-left">Tanggal</th>
                                <th class="py-2 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($archivedPosts ?? [] as $post)
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <td class="py-2 px-4">{{ $post->title }}</td>
                                    <td class="py-2 px-4">{{ $post->content }}</td>
                                    <td class="py-2 px-4">{{ $post->created_at->format('d M Y') }}</td>
                                    <td class="py-2 px-4 space-x-2">
                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                        <form action="{{ route('posts.unarchive', $post) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="text-green-600 hover:underline">Kembalikan</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-2 px-4 text-center text-gray-500">Tidak ada postingan
                                        diarsipkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
