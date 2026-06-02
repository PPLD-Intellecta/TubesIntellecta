<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - CMS Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-purple-100 to-purple-50 p-6 fixed h-full overflow-y-auto">
            <!-- Logo -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-purple-700">Intellecta</h1>
                <p class="text-xs text-purple-600 mt-1">Panel CMS</p>
            </div>

            <!-- Year Section -->
            <div class="mb-8">
                <p class="text-xs font-semibold text-purple-600 uppercase">Tahun Belajar</p>
                <p class="text-sm text-purple-900">2026 Akademi 2026</p>
            </div>

            <!-- Navigation -->
            <nav class="space-y-3 mb-8">
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-purple-200 text-purple-700 rounded-lg font-medium text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    Tagih
                </a>
                <a href="{{ route('admin.videos.index') }}" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm font-bold bg-purple-100">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>
                    Manajemen Video
                </a>
            </nav>

            <!-- Footer Links -->
            <div class="border-t border-purple-200 mt-auto pt-6 space-y-2">
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-purple-700 hover:bg-purple-100 rounded-xl text-sm font-semibold transition-all duration-200">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Pusat Bantuan
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-xl text-sm font-semibold transition-all duration-200 text-left">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 overflow-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">CMS Editorial</h1>
                    <p class="text-gray-600 text-sm mt-2">Kelola pengumuman publik, peringatan sistem, dan kabar internal untuk ekosistem Intellecta</p>
                </div>

                <!-- Content Grid -->
                <div class="grid grid-cols-3 gap-6">
                    <!-- Left Column (2/3) -->
                    <div class="col-span-2 space-y-6">
                        <!-- System Alert Form -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-6">⚠️ Buat Peringatan Sistem</h2>

                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Peringatan</label>
                                        <input type="text" placeholder="Contoh: Pemeliharaan Server" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat Prioritas</label>
                                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                            <option>Kontrol: Pemeliharaan Terjadwal</option>
                                            <option>Prioritas Rendah</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Isi Pesan</label>
                                    <textarea placeholder="Jelaskan pesan peringatan notifikasi anda" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent h-20"></textarea>
                                </div>

                                <div class="flex justify-end gap-3">
                                    <button class="px-6 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg font-medium text-sm transition">Notifikasi</button>
                                    <button class="px-6 py-2 text-white bg-purple-600 hover:bg-purple-700 rounded-full font-medium text-sm transition">Kirim</button>
                                </div>
                            </div>
                        </div>

                        <!-- Announcements Table -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Pengumuman Terbaru</h2>

                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="border-b border-gray-200">
                                            <th class="text-left py-3 px-4 font-semibold text-gray-700 uppercase text-xs">Judul</th>
                                            <th class="text-left py-3 px-4 font-semibold text-gray-700 uppercase text-xs">Hari</th>
                                            <th class="text-left py-3 px-4 font-semibold text-gray-700 uppercase text-xs">Tanggal</th>
                                            <th class="text-left py-3 px-4 font-semibold text-gray-700 uppercase text-xs">Status</th>
                                            <th class="text-left py-3 px-4 font-semibold text-gray-700 uppercase text-xs">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="py-4 px-4">
                                                <div class="font-medium text-gray-900">INFORMATIKA</div>
                                                <div class="text-xs text-gray-500">Struktur Paling Aman Untuk</div>
                                            </td>
                                            <td class="py-4 px-4 text-gray-600">Semua</td>
                                            <td class="py-4 px-4 text-gray-600">Hari</td>
                                            <td class="py-4 px-4">
                                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">✓ Hari Ini</span>
                                            </td>
                                            <td class="py-4 px-4">
                                                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="py-4 px-4">
                                                <div class="font-medium text-gray-900">Pembelajaran Karubalan Masim Gujar 2024</div>
                                                <div class="text-xs text-gray-500">Struktur Paling Aman Untuk</div>
                                            </td>
                                            <td class="py-4 px-4 text-gray-600">Alisa Emily</td>
                                            <td class="py-4 px-4 text-gray-600">Hari</td>
                                            <td class="py-4 px-4">
                                                <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">⏱ Menunggu</span>
                                            </td>
                                            <td class="py-4 px-4">
                                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="py-4 px-4">
                                                <div class="font-medium text-gray-900">Pembelajaran Lali Busa Al-Ibnu</div>
                                                <div class="text-xs text-gray-500">Struktur Paling Aman Untuk</div>
                                            </td>
                                            <td class="py-4 px-4 text-gray-600">Alisa Emily</td>
                                            <td class="py-4 px-4 text-gray-600">Hari</td>
                                            <td class="py-4 px-4">
                                                <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">✕ Tolak</span>
                                            </td>
                                            <td class="py-4 px-4">
                                                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-4 px-4">
                                                <div class="font-medium text-gray-900">Pembelajaran Braswera Dibuka</div>
                                                <div class="text-xs text-gray-500">Struktur Paling Aman Untuk</div>
                                            </td>
                                            <td class="py-4 px-4 text-gray-600">Haya Jul</td>
                                            <td class="py-4 px-4 text-gray-600">Hari</td>
                                            <td class="py-4 px-4">
                                                <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">✕ Tolak</span>
                                            </td>
                                            <td class="py-4 px-4">
                                                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (1/3) -->
                    <div class="space-y-6">
                        <!-- CMS Summary -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex justify-between items-start mb-6">
                                <h2 class="text-lg font-semibold text-gray-900">Ringkasan CMS</h2>
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                            </div>

                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-700 text-sm">Total Pengumuman</span>
                                    <span class="text-gray-900 font-bold text-lg">12.4k</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-700 text-sm">Persentase Publik</span>
                                    <span class="text-gray-900 font-bold text-lg">48.2%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Editor Highlight -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Sorotan Editor</h2>
                            <div class="bg-gray-900 rounded-lg p-4 text-white">
                                <div class="text-xs text-gray-400 uppercase mb-2">Rekomendasi</div>
                                <div class="text-sm font-semibold mb-3">Workingboard Dan</div>
                                <div class="bg-gray-800 rounded h-24 mb-3 flex items-center justify-center text-2xl">📊</div>
                                <p class="text-xs text-gray-400 mb-3">Panduan menggunakan produk presentasi kesalahan konsultasi</p>
                                <a href="#" class="text-cyan-400 text-sm font-semibold hover:text-cyan-300">Lihat Panduan</a>
                            </div>
                        </div>

                        <!-- Alert Banner -->
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                            <div class="text-lg mb-2">💡</div>
                            <h3 class="font-semibold text-yellow-900 mb-1">Lancara Pencapaian</h3>
                            <p class="text-xs text-yellow-800">Anda belum melihat perjalanan tambahan atau rencana konten lainnya yang 100% sesuai dengan Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
