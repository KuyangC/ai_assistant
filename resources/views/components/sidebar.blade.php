<div class="w-64 bg-white shadow-sm border-r border-gray-200 flex flex-col h-screen">
    <!-- Logo/Header -->
    <div class="p-4 border-b border-gray-200">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-robot text-white text-sm"></i>
            </div>
            <span class="font-semibold text-indigo-600">Asisten AI</span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 mt-4">
        <ul class="space-y-1 px-3">
            <li>
                <a href="/" class="flex items-center space-x-3 px-3 py-2 bg-indigo-50 text-indigo-600 rounded-lg">
                    <i class="fas fa-home text-sm"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li>
                <a href="/task"
                    class="flex items-center space-x-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-tasks text-sm"></i>
                    <span>Manajer Tugas</span>
                </a>
            </li>
            <li>
                <a href="/reminder"
                    class="flex items-center space-x-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-bell text-sm"></i>
                    <span>Pengingat</span>
                </a>
            </li>
            <li>
                <a href="/finance"
                    class="flex items-center space-x-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-wallet text-sm"></i>
                    <span>Keuangan</span>
                </a>
            </li>
            <li>
                <a href="/note"
                    class="flex items-center space-x-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-sticky-note text-sm"></i>
                    <span>Catatan</span>
                </a>
            </li>
            <li>
                <a href="/recomendation"
                    class="flex items-center space-x-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-star text-sm"></i>
                    <span>Rekomendasi</span>
                </a>
            </li>
            <li>
                <a href="/journal"
                    class="flex items-center space-x-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-book text-sm"></i>
                    <span>Jurnal</span>
                </a>
            </li>
            <li>
                <a href="/chat"
                    class="flex items-center space-x-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-comments text-sm"></i>
                    <span>Chat AI</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- User Profile - Fixed to bottom of sidebar -->
    <div class="p-4 border-t border-gray-200">
        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg mb-2">
            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center relative">
                <span class="text-white font-medium">M</span>
                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
            </div>
            <div class="flex-1">
                <div class="font-medium text-gray-900">mbut</div>
                <div class="text-sm text-green-600">Online</div>
            </div>
        </div>
        <a href="/login"
            class="inline-block w-full px-3 py-2 text-sm text-center text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors">
            Edit Profil
        </a>
    </div>
</div>
