<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Pribadi - Asisten AI</title>
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
                        <h1 class="text-2xl font-bold text-gray-900">Keuangan Pribadi</h1>
                        <p class="text-gray-600">Lacak pemasukan dan pengeluaran Anda</p>
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

            <!-- Finance Content -->
            <main class="p-6">
                <!-- Page Header with Add Button -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Keuangan Pribadi</h2>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fas fa-plus text-sm"></i>
                        <span>Tambah Transaksi</span>
                    </button>
                </div>

                <!-- Monthly Summary -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Bulanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Income Card -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <div class="text-center">
                                <p class="text-gray-600 text-sm mb-2">Pemasukan</p>
                                <p class="text-3xl font-bold text-green-600">Rp 3.500.000</p>
                            </div>
                        </div>

                        <!-- Expenses Card -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <div class="text-center">
                                <p class="text-gray-600 text-sm mb-2">Pengeluaran</p>
                                <p class="text-3xl font-bold text-red-600">Rp 2.250.000</p>
                            </div>
                        </div>

                        <!-- Balance Card -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <div class="text-center">
                                <p class="text-gray-600 text-sm mb-2">Saldo</p>
                                <p class="text-3xl font-bold text-blue-600">Rp 1.250.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transactions Area -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-wallet text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada transaksi</h3>
                        <p class="text-gray-500 mb-4">Mulai dengan menambahkan transaksi pertama Anda</p>
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg flex items-center space-x-2 mx-auto transition-colors">
                            <i class="fas fa-plus text-sm"></i>
                            <span>Tambah Transaksi Baru</span>
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
