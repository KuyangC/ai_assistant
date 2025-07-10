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
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header for Reminders -->
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

            <!-- Reminders Content -->
            <main class="p-6">
                <!-- Page Header with Add Button -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Pengingat</h2>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fas fa-plus text-sm"></i>
                        <span>Tambah Pengingat</span>
                    </button>
                </div>

                <!-- Reminders Content Area -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-bell text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengingat</h3>
                        <p class="text-gray-500 mb-4">Mulai dengan menambahkan pengingat pertama Anda</p>
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg flex items-center space-x-2 mx-auto transition-colors">
                            <i class="fas fa-plus text-sm"></i>
                            <span>Tambah Pengingat Baru</span>
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
