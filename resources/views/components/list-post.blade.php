@if ($posts->isEmpty())
    <p class="text-center text-amber-50">Belum ada postingan.</p>
@else
    <div class="space-y-6 mt-4">
        @foreach ($posts as $post)
            <div
                class="relative p-4 bg-white dark:bg-gray-800 shadow-md hover:shadow-lg rounded-lg transition-shadow duration-200">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">{{ $post->title }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                    by {{ $post->author }} • {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="text-white mb-8">{{ $post->content }}</p>

                @auth
                    @if (Auth::user()->role === 'admin' || Auth::id() === $post->user_id)
                        <div class="absolute top-4 right-4 flex items-center space-x-2" x-data="{ open: false }">
                            <button type="button"
                                @click.prevent="
                fetch(`/posts/{{ $post->id }}/edit`)
                  .then(res => res.json())
                  .then(data => window.dispatchEvent(
                    new CustomEvent('open-edit-modal', { detail: data })
                  ))
              "
                                class="text-blue-500 hover:text-blue-700 focus:outline-none" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <!-- Dropdown (Titik 3) -->
                            <div class="relative">
                                <button @click="open = !open"
                                    class="text-gray-500 hover:text-gray-700 focus:outline-none px-2" title="Opsi">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div x-show="open" @click.away="open = false" x-transition
                                    class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-700 rounded shadow-lg z-10">
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <i class="fas fa-trash-alt mr-2"></i> Hapus
                                        </button>
                                    </form>
                                    <a href="{{ route('posts.archive', $post->id) }}"
                                        class="block px-4 py-2 text-green-500 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <i class="fas fa-archive mr-2"></i> Arsip
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth

            </div>
        @endforeach
        <hr class="my-4 border-gray-200 dark:border-gray-700">
    </div>
@endif
