<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengingat - Asisten AI</title>
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
                        <h1 class="text-2xl font-bold text-gray-900">Pengingat</h1>
                        <p class="text-gray-600">Set dan kelola pengingat Anda</p>
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
                    <h2 class="text-xl font-semibold text-gray-900">Pengingat</h2>
                    <button id="openModal" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fas fa-plus text-sm"></i>
                        <span>Tambah Pengingat</span>
                    </button>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    @if ($reminders->isEmpty())
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-bell text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengingat</h3>
                            <p class="text-gray-500 mb-4">Mulai dengan menambahkan pengingat pertama Anda</p>
                        </div>
                    @else
                        <ul class="space-y-4">
                            @foreach ($reminders as $reminder)
                                <li class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                    <div>
                                        <h4 class="text-md font-medium text-gray-900">{{ $reminder->title }}</h4>
                                        <p class="text-gray-500 text-sm">{{ $reminder->description }}</p>
                                        <p class="text-gray-500 text-sm">Tanggal: {{ $reminder->reminder_date }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button onclick="toggleReminder({{ $reminder->id }})" class="text-green-600 hover:text-green-800">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button onclick="confirmDeleteReminder({{ $reminder->id }})" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- Notification Toast -->
    <div id="notification" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg max-w-sm">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2 text-green-600"></i>
                <span id="notificationText" class="text-sm font-medium"></span>
            </div>
        </div>
    </div>

    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Pengingat Baru</h3>
            <form id="reminderForm" action="{{ route('reminders.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="3"></textarea>
                </div>
                <div>
                    <label for="reminder_date" class="block text-sm font-medium text-gray-700">Tanggal Pengingat</label>
                    <input type="datetime-local" name="reminder_date" id="reminder_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
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
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('modal').classList.add('hidden');
        });

        document.getElementById('modal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('modal')) {
                document.getElementById('modal').classList.add('hidden');
            }
        });

        // Handle form submission
        document.getElementById('reminderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    showNotification('Pengingat berhasil ditambahkan!', 'success');
                    document.getElementById('modal').classList.add('hidden');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showNotification('Gagal menambahkan pengingat', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat menambahkan pengingat', 'error');
            });
        });

        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            const notificationDiv = notification.querySelector('div');
            const icon = notification.querySelector('i');
            
            notificationText.textContent = message;
            
            // Set styling based on type
            if (type === 'success') {
                notificationDiv.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg max-w-sm';
                icon.className = 'fas fa-check-circle mr-2 text-green-600';
            } else if (type === 'error') {
                notificationDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg max-w-sm';
                icon.className = 'fas fa-exclamation-circle mr-2 text-red-600';
            }
            
            notification.classList.remove('hidden');
            
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 3000);
        }

        async function confirmDeleteReminder(reminderId) {
            if (confirm('Apakah Anda yakin ingin menghapus pengingat ini?')) {
                try {
                    console.log('Deleting reminder:', reminderId);
                    const response = await fetch(`/reminder/${reminderId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    });

                    console.log('Response status:', response.status);
                    if (response.ok) {
                        console.log('Reminder deleted successfully');
                        showNotification('Pengingat berhasil dihapus!', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        console.error('Delete failed:', response.status);
                        const errorText = await response.text();
                        console.error('Error response:', errorText);
                        showNotification('Gagal menghapus pengingat', 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showNotification('Terjadi kesalahan saat menghapus pengingat', 'error');
                }
            }
        }

        async function toggleReminder(reminderId) {
            try {
                const response = await fetch(`/reminder/${reminderId}/toggle`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    showNotification('Status pengingat berhasil diubah!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showNotification('Gagal mengubah status pengingat', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat mengubah status pengingat', 'error');
            }
        }
    </script>
</body>
</html> 