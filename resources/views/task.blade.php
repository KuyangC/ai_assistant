<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajer Tugas - Asisten AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <x-sidebar />
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Manajer Tugas</h1>
                        <p class="text-gray-600">Kelola tugas harian dan prioritas Anda</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Cari apapun..."
                                class="w-80 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Task Management Content -->
            <main class="p-6">
                <!-- Page Header with Add Button -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Manajer Tugas</h2>
                    <button onclick="openTaskModal()"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fas fa-plus text-sm"></i>
                        <span>Tambah Tugas</span>
                    </button>
                </div>

                <!-- Filter Tabs -->
                <div class="mb-6">
                    <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg w-fit" id="tabContainer">
                        <button
                            class="px-4 py-2 {{ $filter === 'all' ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:text-gray-900' }} rounded-md text-sm font-medium transition-colors"
                            onclick="setActiveTab('all')">
                            Semua
                        </button>
                        <button
                            class="px-4 py-2 {{ $filter === 'today' ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:text-gray-900' }} rounded-md text-sm font-medium transition-colors"
                            onclick="setActiveTab('today')">
                            Hari Ini
                        </button>
                        <button
                            class="px-4 py-2 {{ $filter === 'week' ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:text-gray-900' }} rounded-md text-sm font-medium transition-colors"
                            onclick="setActiveTab('week')">
                            Minggu Ini
                        </button>
                        <button
                            class="px-4 py-2 {{ $filter === 'completed' ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:text-gray-900' }} rounded-md text-sm font-medium transition-colors"
                            onclick="setActiveTab('completed')">
                            Selesai
                        </button>
                    </div>
                </div>

                <!-- Tasks Content Area -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    @if ($tasks->isEmpty())
                        <div class="text-center py-12">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-tasks text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada tugas</h3>
                            <p class="text-gray-500 mb-4">Mulai dengan menambahkan tugas pertama Anda</p>
                            <button onclick="openTaskModal()"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg flex items-center space-x-2 mx-auto transition-colors">
                                <i class="fas fa-plus text-sm"></i>
                                <span>Tambah Tugas Baru</span>
                            </button>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($tasks as $task)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start space-x-3">
                                            <input type="checkbox"
                                                class="mt-1 h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                {{ $task->completed ? 'checked' : '' }}
                                                onclick="toggleTaskCompletion({{ $task->id }}, this)">
                                            <div>
                                                <h3
                                                    class="font-medium {{ $task->completed ? 'line-through text-gray-400' : 'text-gray-900' }}">
                                                    {{ $task->title }}
                                                </h3>
                                                @if ($task->description)
                                                    <p class="text-gray-600 text-sm mt-1">{{ $task->description }}</p>
                                                @endif
                                                <div class="flex items-center space-x-4 mt-2">
                                                    @if ($task->due_date)
                                                        <span
                                                            class="text-sm {{ $task->due_date < now() && !$task->completed ? 'text-red-500' : 'text-gray-500' }}">
                                                            <i class="far fa-calendar-alt mr-1"></i>
                                                            {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                                                        </span>
                                                    @endif
                                                    @if ($task->priority)
                                                        <span
                                                            class="text-sm px-2 py-1 rounded-full 
                                                            {{ $task->priority === 'high'
                                                                ? 'bg-red-100 text-red-800'
                                                                : ($task->priority === 'medium'
                                                                    ? 'bg-yellow-100 text-yellow-800'
                                                                    : 'bg-green-100 text-green-800') }}">
                                                            {{ ucfirst($task->priority) }} priority
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button onclick="openEditModal({{ $task->id }})"
                                                class="text-gray-500 hover:text-indigo-600 transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="confirmDelete({{ $task->id }})"
                                                class="text-gray-500 hover:text-red-600 transition-colors">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- Task Modal -->
    <div id="taskModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg w-full max-w-md">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="modalTitle">Tambah Tugas Baru</h3>
                <form id="taskForm" method="POST">
                    @csrf
                    <input type="hidden" id="taskId" name="id">
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                            <input type="text" id="title" name="title" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description" name="description" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>
                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700">Tanggal Jatuh
                                Tempo</label>
                            <input type="date" id="due_date" name="due_date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700">Prioritas</label>
                            <select id="priority" name="priority"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="low">Rendah</option>
                                <option value="medium" selected>Sedang</option>
                                <option value="high">Tinggi</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function setActiveTab(tab) {
            window.location.href = "{{ route('tasks.index') }}?filter=" + tab;
        }

        function openTaskModal(task = null) {
            const modal = document.getElementById('taskModal');
            const form = document.getElementById('taskForm');
            const modalTitle = document.getElementById('modalTitle');

            if (task) {
                modalTitle.textContent = 'Edit Tugas';
                form.action = "{{ route('tasks.update', ['task' => '__task_id__']) }}".replace('__task_id__', task.id);
                form.method = "POST";
                // Add method spoofing for PUT request
                form.innerHTML += '<input type="hidden" name="_method" value="PUT">';
                document.getElementById('taskId').value = task.id;
                document.getElementById('title').value = task.title;
                document.getElementById('description').value = task.description || '';
                document.getElementById('due_date').value = task.due_date ? task.due_date.split('T')[0] : '';
                document.getElementById('priority').value = task.priority || 'medium';
            } else {
                modalTitle.textContent = 'Tambah Tugas Baru';
                form.action = "{{ route('tasks.store') }}";
                form.method = "POST";
                form.reset();
                document.getElementById('taskId').value = '';
                // Remove method spoofing if exists
                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput) methodInput.remove();
            }

            modal.classList.remove('hidden');
        }

        async function openEditModal(taskId) {
            try {
                const response = await fetch(`/tasks/${taskId}/edit`);
                const task = await response.json();
                openTaskModal(task);
            } catch (error) {
                console.error('Error:', error);
            }
        }

        function closeModal() {
            document.getElementById('taskModal').classList.add('hidden');
        }

        async function toggleTaskCompletion(taskId, checkbox) {
            const completed = checkbox.checked;
            try {
                const response = await fetch(`/tasks/${taskId}/toggle`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        completed
                    })
                });

                if (response.ok) {
                    window.location.reload();
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }

        async function confirmDelete(taskId) {
            if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                try {
                    const response = await fetch(`/tasks/${taskId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    if (response.ok) {
                        window.location.reload();
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }
        }

        // Close modal when clicking outside
        document.getElementById('taskModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>

</html>
