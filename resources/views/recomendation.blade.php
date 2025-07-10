<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Pribadi - Asisten AI</title>
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
                        <h1 class="text-2xl font-bold text-gray-900">Rekomendasi Pribadi</h1>
                        <p class="text-gray-600">Rekomendasi pribadi untuk Anda</p>
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

            <!-- Recommendations Content -->
            <main class="p-6">
                <!-- Page Header -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Rekomendasi Pribadi</h2>
                </div>

                <!-- Recommendations Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Food Recommendation Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 text-center">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-utensils text-indigo-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Rekomendasi Makanan</h3>
                        <p class="text-gray-600 text-sm mb-4">Berdasarkan preferensi Anda, coba restoran Italia baru di pusat kota!</p>
                        <button class="bg-white border border-indigo-600 text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-50 transition-colors text-sm">
                            Pelajari Lebih Lanjut
                        </button>
                    </div>

                    <!-- Entertainment Recommendation Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 text-center">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-film text-indigo-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Hiburan</h3>
                        <p class="text-gray-600 text-sm mb-4">Film sci-fi baru yang sesuai dengan selera Anda!</p>
                        <button class="bg-white border border-indigo-600 text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-50 transition-colors text-sm">
                            Pelajari Lebih Lanjut
                        </button>
                    </div>

                    <!-- Activity Suggestion Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 text-center">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-dumbbell text-indigo-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Saran Aktivitas</h3>
                        <p class="text-gray-600 text-sm mb-4">Cuaca sempurna untuk jogging pagi di taman!</p>
                        <button class="bg-white border border-indigo-600 text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-50 transition-colors text-sm">
                            Pelajari Lebih Lanjut
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
