<div id="posts-container" class="space-y-6 mt-4">
    <p id="loading" class="text-center text-white">Memuat postingan...</p>
</div>

<script>
    const currentUserId = {{ auth()->id() ?? 'null' }};
    const currentUserRole = '{{ auth()->user()->role ?? 'guest' }}';

    document.addEventListener('DOMContentLoaded', function () {
        fetch('/api/posts')
            .then(res => res.json())
            .then(posts => {
                const container = document.getElementById('posts-container');
                container.innerHTML = '';

                if (posts.length === 0) {
                    container.innerHTML = '<p class="text-center text-amber-50">Belum ada postingan.</p>';
                    return;
                }

                posts.forEach(post => {
                    const card = document.createElement('div');
                    card.className = "relative p-4 bg-white dark:bg-gray-800 shadow-md hover:shadow-lg rounded-lg transition-shadow duration-200 mb-4";

                    const tanggal = new Date(post.created_at).toLocaleDateString();

                    let actions = '';
                    if (currentUserRole === 'admin' || currentUserId === post.user_id) {
                        actions = `
                        <div class="absolute top-4 right-4 flex items-center space-x-2" x-data="{ open: false }">
                            <button type="button"
                                @click.prevent="
                                    fetch('/posts/${post.id}/edit')
                                        .then(res => res.json())
                                        .then(data => window.dispatchEvent(
                                            new CustomEvent('open-edit-modal', { detail: data })
                                        ))
                                "
                                class="text-blue-500 hover:text-blue-700 focus:outline-none" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <div class="relative">
                                <button @click='open = !open' class="text-gray-500 hover:text-gray-700 focus:outline-none px-2" title="Opsi">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div x-show='open' @click.away='open = false' x-transition
                                    class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-700 rounded shadow-lg z-10">
                                    <form action="/posts/${post.id}" method="POST" class="block">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <i class="fas fa-trash-alt mr-2"></i> Hapus
                                        </button>
                                    </form>
                                    <form action="/posts/${post.id}/archive" method="POST" class="block">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 text-green-500 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <i class="fas fa-archive mr-2"></i> Arsip
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>`;
                    }

                    card.innerHTML = `
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">${post.title}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                            by ${post.author} • ${tanggal}
                        </p>
                        <p class="text-white mb-8">${post.content}</p>
                        ${actions}
                    `;

                    container.appendChild(card);
                });
            })
            .catch(error => {
                document.getElementById('posts-container').innerHTML = '<p class="text-red-500">Gagal memuat data.</p>';
                console.error('Fetch error:', error);
            });
    });
</script>