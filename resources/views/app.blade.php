<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Asisten AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <x-sidebar />

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <x-header />
            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <!-- Card 1 -->
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $taskCount ?? 0 }}</p>
                                <p class="text-gray-600 text-sm mt-1">Tugas Hari Ini</p>
                            </div>
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tasks text-indigo-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $reminderCount ?? 0 }}</p>
                                <p class="text-gray-600 text-sm mt-1">Pengingat</p>
                            </div>
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-bell text-indigo-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $transactionCount ?? 0 }}</p>
                                <p class="text-gray-600 text-sm mt-1">Transaksi</p>
                            </div>
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-wallet text-indigo-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $noteCount ?? 0 }}</p>
                                <p class="text-gray-600 text-sm mt-1">Catatan</p>
                            </div>
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-sticky-note text-indigo-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">Aksi Cepat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                        <button class="bg-white p-3 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow text-left">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-plus text-indigo-600 text-sm"></i>
                                <span class="text-gray-900 text-sm">Tambah Tugas</span>
                            </div>
                        </button>
                        <button class="bg-white p-3 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow text-left">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-bell text-indigo-600 text-sm"></i>
                                <span class="text-gray-900 text-sm">Set Pengingan</span>
                            </div>
                        </button>
                        <button class="bg-white p-3 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow text-left">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-sticky-note text-indigo-600 text-sm"></i>
                                <span class="text-gray-900 text-sm">Catatan Baru</span>
                            </div>
                        </button>
                        <button class="bg-white p-3 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow text-left">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-question text-indigo-600 text-sm"></i>
                                <span class="text-gray-900 text-sm">Tanya AI</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">Aktivitas Terbaru</h2>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                        <div class="space-y-4">
                            @forelse($recentActivities as $activity)
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <i class="{{ $activity->icon }} text-green-600 text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-900 text-sm">{{ $activity->description }}</p>
                                        <p class="text-gray-500 text-xs mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <p class="text-gray-500 text-sm">Belum ada aktivitas</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
