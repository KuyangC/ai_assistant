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
        <div class="flex-1 overflow-auto">
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

            <main class="p-6">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Keuangan Pribadi</h2>
                    <button id="openModal" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fas fa-plus text-sm"></i>
                        <span>Tambah Transaksi</span>
                    </button>
                </div>

                <!-- Monthly Summary -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Bulanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <div class="text-center">
                                <p class="text-gray-600 text-sm mb-2">Pemasukan</p>
                                <p class="text-3xl font-bold text-green-600">Rp. {{ number_format($totalIncome, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <div class="text-center">
                                <p class="text-gray-600 text-sm mb-2">Pengeluaran</p>
                                <p class="text-3xl font-bold text-red-600">Rp. {{ number_format($totalExpense, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <div class="text-center">
                                <p class="text-gray-600 text-sm mb-2">Saldo</p>
                                <p class="text-3xl font-bold text-blue-600">Rp. {{ number_format($balance, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transactions Area -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    @if ($transactions->isEmpty())
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-wallet text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada transaksi</h3>
                            <p class="text-gray-500 mb-4">Mulai dengan menambahkan transaksi pertama Anda</p>
                        </div>
                    @else
                        <ul class="space-y-4">
                            @foreach ($transactions as $transaction)
                                <li class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                    <div>
                                        <h4 class="text-md font-medium text-gray-900">{{ $transaction->description }}</h4>
                                        <p class="text-gray-500 text-sm">Tanggal: {{ $transaction->date }}</p>
                                        <p class="text-gray-500 text-sm">
                                            @if ($transaction->type === 'income')
                                                <span class="text-green-600">+Rp. {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                                            @else
                                                <span class="text-red-600">-Rp. {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
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

    <!-- Modal for Adding Transaction -->
    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Transaksi Baru</h3>
            <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <input type="text" name="description" id="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah (misal: Rp. 10.000)</label>
                    <input type="number" name="amount" id="amount" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan jumlah tanpa Rp. (contoh: 10000)" required>
                    <p class="text-xs text-gray-500 mt-1">Gunakan format numerik, misalnya 10000 untuk Rp. 10.000</p>
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipe</label>
                    <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="income">Pemasukan</option>
                        <option value="expense">Pengeluaran</option>
                    </select>
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="date" id="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
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
    </script>
</body>
</html>