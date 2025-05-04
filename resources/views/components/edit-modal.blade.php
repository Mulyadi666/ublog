<div 
    x-data="editModal()"
    x-cloak
    x-show="open"
    x-transition.opacity
    class="fixed inset-0 flex items-center justify-center z-50"
>
  <div class="absolute inset-0 bg-black opacity-50" @click="closeModal()"></div>
  <div class="bg-white rounded-lg shadow-lg z-10 p-6 w-11/12 md:w-1/2" @click.outside="closeModal()">
    <h2 class="text-xl font-bold mb-4">Edit Postingan</h2>

    <form :action="`/posts/${postId}`" method="POST" @submit.prevent="submit()">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="block mb-1">Judul</label>
        <input type="text" x-model="postTitle" name="title" class="w-full p-2 border rounded" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Penulis</label>
        <input type="text" x-model="postAuthor" name="author" class="w-full p-2 border rounded" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Isi</label>
        <textarea x-model="postContent" name="content" rows="4" class="w-full p-2 border rounded" required></textarea>
      </div>

      <div class="flex justify-end space-x-2">
        <button type="button" @click="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
function editModal() {
  return {
    open: false,
    postId: null,
    postTitle: '',
    postAuthor: '',
    postContent: '',
    openModal(data) {
      this.postId      = data.id;
      this.postTitle   = data.title;
      this.postAuthor  = data.author;
      this.postContent = data.content;
      this.open        = true;
    },
    closeModal() {
      this.open = false;
    },
    submit() {
      fetch(`/posts/${this.postId}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
          title: this.postTitle,
          author: this.postAuthor,
          content: this.postContent,
        })
      })
      .then(res => res.json())
      .then(res => {
        if (res.success) {
          // contoh: reload halaman atau update DOM secara dinamis
          window.location.reload();
        } else {
          alert('Gagal mengupdate');
        }
      });
    }
  }
}

// Dengarkan event untuk buka modal
window.addEventListener('open-edit-modal', e => {
  document.querySelector('[x-data="editModal()"]').__x.$data.openModal(e.detail);
});
</script>
