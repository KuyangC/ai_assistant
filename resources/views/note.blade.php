<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan AI & Memori - Asisten AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <x-sidebar />
        <div class="flex-1 overflow-auto">
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Catatan AI & Memori</h1>
                        <p class="text-gray-600">Catatan dan memori AI Anda</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Cari apapun..." class="w-80 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                        </div>
                        <div class="relative">
                            <button class="p-2 text-gray-600 hover:text-gray-900">
                                <i class="fas fa-bell text-lg"></i>
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">1</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-6">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Catatan AI & Memori</h2>
                    <button id="openModal" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fas fa-plus text-sm"></i>
                        <span>Catatan Baru</span>
                    </button>
                </div>

                <!-- Notes Content Area -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    @if ($notes->isEmpty())
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-sticky-note text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada catatan</h3>
                            <p class="text-gray-500 mb-4">Mulai dengan membuat catatan pertama Anda dengan bantuan AI</p>
                            <button id="openModalEmpty" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg flex items-center space-x-2 mx-auto transition-colors">
                                <i class="fas fa-plus text-sm"></i>
                                <span>Buat Catatan Baru</span>
                            </button>
                        </div>
                    @else
                        <ul class="space-y-4">
                            @foreach ($notes as $note)
                                <li class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                    <div>
                                        <h4 class="text-md font-medium text-gray-900">{{ $note->title }}</h4>
                                        <p class="text-gray-500 text-sm">{{ Str::limit($note->content, 50) }}</p>
                                        <p class="text-gray-500 text-xs">Dibuat: {{ $note->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('notes.edit', $note->id) }}" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus catatan ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- Modal for Adding/Editing Note -->
    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold text-gray-900 mb-4" id="modalTitle">Catatan Baru</h3>
            <form action="{{ route('notes.store') }}" method="POST" id="noteForm" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="noteId">
                <input type="hidden" name="_method" value="POST">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Isi Catatan</label>
                    <textarea name="content" id="content" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="4" required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="closeModal" class="px-4 py-2 text-gray-600 hover:text-gray-900">Batal</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('openModal').addEventListener('click', () => {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Catatan Baru';
            document.getElementById('noteForm').action = '{{ route('notes.store') }}';
            document.getElementById('noteId').value = '';
            document.getElementById('title').value = '';
            document.getElementById('content').value = '';
        });

        document.getElementById('openModalEmpty').addEventListener('click', () => {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Catatan Baru';
            document.getElementById('noteForm').action = '{{ route('notes.store') }}';
            document.getElementById('noteId').value = '';
            document.getElementById('title').value = '';
            document.getElementById('content').value = '';
        });

        document.querySelectorAll('.fa-edit').forEach(editButton => {
            editButton.addEventListener('click', (e) => {
                e.preventDefault();
                const link = e.target.closest('a');
                if (!link) {
                    console.error('Link edit tidak ditemukan');
                    return;
                }
                const noteId = link.getAttribute('href').split('/').pop();
                console.log('Mengambil data untuk ID:', noteId);

                fetch(`/note/${noteId}/edit`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Gagal mengambil data: ${response.statusText} (Status: ${response.status})`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data diterima:', data);
                        if (data.error) {
                            alert(data.error);
                            return;
                        }
                        const modal = document.getElementById('modal');
                        const modalTitle = document.getElementById('modalTitle');
                        const noteForm = document.getElementById('noteForm');
                        const noteIdInput = document.getElementById('noteId');
                        const titleInput = document.getElementById('title');
                        const contentInput = document.getElementById('content');

                        if (!modal || !modalTitle || !noteForm || !noteIdInput || !titleInput || !contentInput) {
                            console.error('Elemen modal atau input tidak ditemukan:', { modal, modalTitle, noteForm, noteIdInput, titleInput, contentInput });
                            return;
                        }

                        modal.classList.remove('hidden');
                        modalTitle.textContent = 'Edit Catatan';
                        noteForm.action = '{{ route('notes.update', ['id' => ':id']) }}'.replace(':id', data.id);
                        noteIdInput.value = data.id || '';
                        titleInput.value = data.title || '';
                        contentInput.value = data.content || '';
                        noteForm.method = 'POST';
                        const methodInput = document.querySelector('#noteForm [name="_method"]');
                        if (methodInput) methodInput.value = 'PUT';
                        else console.error('Input _method tidak ditemukan');
                    })
                    .catch(error => {
                        console.error('Error saat fetch:', error);
                        alert('Terjadi kesalahan saat mengambil data catatan: ' + error.message);
                    });
            });
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('modal').classList.add('hidden');
        });

        document.getElementById('modal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('modal')) {
                document.getElementById('modal').classList.add('hidden');
            }
        });
    </script>
</body>
</html>