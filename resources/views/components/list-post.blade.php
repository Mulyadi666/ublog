@if($posts->isEmpty())
  <p class="text-center text-amber-50">Belum ada postingan.</p>
@else
  <div class="space-y-6 mt-4">
    @foreach($posts as $post)
      <div class="relative p-6 border rounded-lg bg-white dark:bg-gray-800 shadow-sm hover:shadow-md transition-shadow">
        <h2 class="text-2xl text-white font-bold mb-2" >{{ $post->title }}</h2>
        <p class="text-sm text-gray-500 mb-4">
          by {{ $post->author }} • {{ $post->created_at->diffForHumans() }}
        </p>
        <p class="text-white mb-8">{{ $post->content }}</p>

        @auth
          <div class="absolute bottom-4 right-4 flex space-x-3">
            {{-- <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700" title="Edit">
              <i class="fas fa-edit"></i>
            </a> --}}
            {{-- <a href="#"
              @click.prevent="
                fetch(`/posts/{{ $post->id }}/edit`)
                  .then(res => res.json())
                  .then(data => window.dispatchEvent(
                    new CustomEvent('open-edit-modal', { detail: data })
                  ))
              "
              class="text-blue-500 hover:text-blue-700"
              title="Edit">
              <i class="fas fa-edit"></i>
            </a> --}}
            <button
  @click.prevent="
    fetch(`/posts/{{ $post->id }}/edit`)
      .then(res => res.json())
      .then(data => window.dispatchEvent(
        new CustomEvent('open-edit-modal', { detail: data })
      ))
  "
  class="text-blue-500 hover:text-blue-700"
  title="Edit"
>
  <i class="fas fa-edit"></i>
</button>



            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
            <a href="{{ route('posts.archive', $post->id) }}" class="text-green-500 hover:text-green-700" title="Arsip">
              <i class="fas fa-archive"></i>
            </a>
          </div>
        @endauth
      </div>
    @endforeach
  </div>
@endif
