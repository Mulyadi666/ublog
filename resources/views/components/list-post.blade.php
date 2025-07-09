@if($posts->isEmpty())
  <p class="text-center text-amber-50">Belum ada postingan.</p>
@else
  <div class="space-y-6 mt-4">
    @foreach($posts as $post)      
      <div class="relative p-4 bg-white dark:bg-gray-800 shadow-md hover:shadow-lg rounded-lg transition-shadow duration-200">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">{{ $post->title }}</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
          by {{ $post->author }} • {{ $post->created_at->diffForHumans() }}
        </p>
        <p class="text-white mb-8">{{ $post->content }}</p>

        @auth
          <div class="absolute bottom-4 right-4 flex space-x-3">
            <button
            type="button"
            @click.prevent="
              fetch(`/posts/{{ $post->id }}/edit`)
                .then(res => res.json())
                .then(data => window.dispatchEvent(
                  new CustomEvent('open-edit-modal', { detail: data })
                ))
            "
            class="text-blue-500 hover:text-blue-700 focus:outline-none"
            title="Edit"
          >
            <i class="fas fa-edit"></i>
          </button>
          
          <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none" title="Hapus">
              <i class="fas fa-trash-alt"></i>
            </button>
          </form>
          
          <a href="{{ route('posts.archive', $post->id) }}" class="text-green-500 hover:text-green-700 focus:outline-none" title="Arsip">
            <i class="fas fa-archive"></i>
          </a>
          </div>
        @endauth
      </div>
    @endforeach
    <hr class="my-4 border-gray-200 dark:border-gray-700">
  </div>
@endif
