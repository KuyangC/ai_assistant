<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat AI - Asisten AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <x-sidebar />
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Asisten AI</h1>
                        <p class="text-gray-600">Tanya saya apapun tentang tugas, pengingan, atau dapatkan rekomendasi!</p>
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

            <!-- Chat Content -->
            <main class="flex-1 flex flex-col p-6">
                <!-- Page Header -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Asisten AI</h2>
                    <p class="text-gray-600 text-sm">Tanya saya apapun tentang tugas, pengingan, atau dapatkan rekomendasi!</p>
                </div>

                <!-- Chat Messages Container -->
                <div class="flex-1 bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col">
                    <!-- Messages Area -->
                    <div class="flex-1 p-6 overflow-y-auto space-y-4">
                        <!-- AI Message 1 -->
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-robot text-white text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                                    <p class="text-gray-900 text-sm">Halo! Saya asisten AI Anda. Bagaimana saya bisa membantu hari ini?</p>
                                </div>
                                <p class="text-gray-500 text-xs mt-1">Baru saja</p>
                            </div>
                        </div>

                        <!-- User Message -->
                        <div class="flex items-start space-x-3 justify-end">
                            <div class="flex-1 flex flex-col items-end">
                                <div class="bg-indigo-600 rounded-lg p-3 max-w-md">
                                    <p class="text-white text-sm">test</p>
                                </div>
                                <div class="flex items-center space-x-1 mt-1">
                                    <p class="text-gray-500 text-xs">2:16:15 AM</p>
                                    <i class="fas fa-check text-green-500 text-xs"></i>
                                </div>
                            </div>
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                        </div>

                        <!-- AI Message 2 -->
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-robot text-white text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                                    <p class="text-gray-900 text-sm">Maaf, server AI tidak merespon.</p>
                                </div>
                                <p class="text-gray-500 text-xs mt-1">2:16:17 AM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Message Input -->
                    <div class="border-t border-gray-200 p-4">
                        <div class="flex items-center space-x-3">
                            <input type="text" placeholder="Ketik pesan Anda..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white p-2 rounded-lg transition-colors">
                                <i class="fas fa-paper-plane text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
