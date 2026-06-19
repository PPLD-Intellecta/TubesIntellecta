<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Moderasi Forum</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        
        <!-- Sidebar Ungu Panel CMS -->
        <aside class="w-64 bg-gradient-to-b from-purple-100 to-purple-50 p-6 fixed h-full overflow-y-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-purple-700">Intellecta</h1>
                <p class="text-xs text-purple-600 mt-1">Panel CMS</p>
            </div>

            <div class="mb-8">
                <p class="text-xs font-semibold text-purple-600 uppercase">Tahun Belajar</p>
                <p class="text-sm text-purple-900">2026 Akademi 2026</p>
            </div>

            <nav class="space-y-3 mb-8">
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                    Kursus Saya
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    Tagih
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
                    Pesan
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>
                    Manajemen Video
                </a>
                <a href="{{ route('admin.forum.index') }}" class="flex items-center gap-3 px-4 py-2 bg-purple-200 text-purple-700 rounded-lg font-medium text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10c.55 0 1-.45 1-1z"/></svg>
                    Moderasi Forum
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    Berita & Pengumuman
                </a>
            </nav>
        </aside>

        <!-- Main Content (Area Kanan) -->
        <main class="ml-64 flex-1 overflow-auto">
            <div class="p-8">
                
                <!-- Header Halaman -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Moderasi Forum</h1>
                    <p class="text-gray-600 text-sm mt-2">Pantau aduan pesan tidak pantas pada ruang diskusi interaktif antara siswa dan pengajar terkait materi pembelajaran.</p>
                </div>

                <!-- Konten Grid Samping-Sampingan -->
                <div class="grid grid-cols-3 gap-6">
                    
                    <!-- Kolom Kiri: Laporan Masuk -->
                    <div class="col-span-2 space-y-4">
                        
                        <!-- Aduan 1 (Siswa melanggar ketentuan diskusi materi) -->
                        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex justify-between items-start">
                            <div class="space-y-2">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-sm text-gray-900">Rian Hidayat</span>
                                    <span class="text-xs text-gray-400">Siswa • 5 menit yang lalu</span>
                                    <span class="px-2.5 py-0.5 bg-red-100 text-red-700 text-[10px] font-bold rounded-full uppercase">Komentar Tidak Pantas</span>
                                </div>
                                <p class="text-gray-700 text-sm">"Tutornya kalau jelasin materi kuis belibet banget sih, ga paham gua. Mending ganti pengajar aja lah malesin."</p>
                                <div class="text-xs text-purple-600 font-medium bg-purple-50 px-2 py-1 rounded inline-block">
                                    📚 Materi: Evaluasi Kuis Pemrograman Dasar
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button type="button" onclick="alert('Laporan diabaikan')" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition">Abaikan</button>
                                <button type="button" onclick="this.closest('.bg-white').remove(); alert('Pesan berhasil dihapus!')" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-lg transition">Hapus Pesan</button>
                            </div>
                        </div>

                        <!-- Aduan 2 (Spam di luar materi pembelajaran) -->
                        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex justify-between items-start">
                            <div class="space-y-2">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-sm text-gray-900">Dimas Saputra</span>
                                    <span class="text-xs text-gray-400">Siswa • 1 jam yang lalu</span>
                                    <span class="px-2.5 py-0.5 bg-yellow-100 text-yellow-700 text-[10px] font-bold rounded-full uppercase">Spam Luar Topik</span>
                                </div>
                                <p class="text-gray-700 text-sm">"Open joki tugas project akhir dan kuis jaminan nilai A++!! Yang minat langsung PC akun telegram gua ya gan."</p>
                                <div class="text-xs text-purple-600 font-medium bg-purple-50 px-2 py-1 rounded inline-block">
                                    📚 Materi: Diskusi Umum Modul React Native
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button type="button" onclick="alert('Laporan diabaikan')" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition">Abaikan</button>
                                <button type="button" onclick="this.closest('.bg-white').remove(); alert('Pesan komersial berhasil dihapus!')" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-lg transition">Hapus Pesan</button>
                            </div>
                        </div>

                    </div>

                    <!-- Kolom Kanan: Statistik Ringkasan -->
                    <div class="space-y-6">
                        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                            <h2 class="text-base font-semibold text-gray-900 mb-4">Ringkasan Forum</h2>
                            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-xs">Aduan Belum Selesai</span>
                                    <span class="text-red-600 font-bold text-sm">2 Laporan</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-xs">Diskusi Aktif (Siswa & Pengajar)</span>
                                    <span class="text-gray-900 font-bold text-sm">48 Topik</span>
                                </div>
                            </div>
                        </div>

                        <!-- Box Pedoman Konten -->
                        <div class="bg-gray-950 rounded-xl p-6 text-white shadow-sm">
                            <div class="text-xs text-gray-400 tracking-wider mb-2 uppercase">Ketentuan Ruang Diskusi</div>
                            <h3 class="text-sm font-semibold mb-3">Fokus Materi Pembelajaran</h3>
                            <p class="text-xs text-gray-400 leading-relaxed">
                                Sesuai dengan tujuan platform, pastikan seluruh interaksi di dalam forum berpusat pada pembahasan materi belajar. Tindak tegas akun yang melakukan promosi ilegal atau perundungan.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>
</body>
</html>