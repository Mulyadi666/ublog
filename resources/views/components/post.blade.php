{{-- resources/views/post.blade.php --}}
<form action="{{ route('posts.store') }}" method="POST">
  @csrf
  <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 p-4 space-y-4">

    {{-- Judul --}}
    <div>
      {{-- <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label> --}}
      <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title') }}"
        placeholder="Masukkan judul..."
        required
        class="w-full p-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg
               focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600
               dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
      >
      @error('title')
        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
      @enderror
    </div>

    {{-- Penulis --}}
    <div>
      {{-- <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis</label> --}}
      <input
        type="text"
        id="author"
        name="author"
        value="{{ old('author') }}"
        placeholder="Nama penulis..."
        required
        class="w-full p-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg
               focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600
               dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
      >
      @error('author')
        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
      @enderror
    </div>

    {{-- Isi/Postingan --}}
    <div>
      {{-- <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Isi Postingan</label> --}}
      <textarea
        id="content"
        name="content"
        rows="4"
        placeholder="Tulis isi postingan..."
        required
        class="w-full p-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg
               focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600
               dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
      >{{ old('content') }}</textarea>
      @error('content')
        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
      @enderror
    </div>

    {{-- Tombol Post --}}
    <div class="flex items-center justify-between border-t dark:border-gray-600 border-gray-200 pt-2">
      <button
        type="submit"
        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-white bg-blue-700
               rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800 cursor-pointer"
      >
        Post
      </button>
      {{-- (opsional) tombol icon lainnya --}}
    </div>

  </div>
</form>

<p class="ms-auto text-xs text-gray-500 dark:text-gray-400">
  Remember, contributions to this topic should follow our
  <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">Community Guidelines</a>.
</p>
  