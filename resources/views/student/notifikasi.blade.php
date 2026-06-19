<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Notifikasi Belajar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        
        <!-- Sidebar Ungu Siswa (Kembali Dimunculkan & Dikunci di Kiri) -->
        <aside class="w-64 bg-gradient-to-b from-purple-100 to-purple-50 p-6 fixed h-full overflow-y-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-purple-700">Intellecta</h1>
                <p class="text-xs text-purple-600 mt-1">Alur Belajar</p>
            </div>

            <div class="mb-8">
                <p class="text-xs font-semibold text-purple-600 uppercase">Tahun Akademik</p>
                <p class="text-sm text-purple-900">2026</p>
            </div>

            <nav class="space-y-3 mb-8">
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                    Kuis & Evaluasi
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                    Paket Belajar
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
                    Feedback
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>
                    Materi Video
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    Kelas Live
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    Study Planner
                </a>
                
                <!-- Menu Notifikasi Belajar Aktif Jatah Kamu -->
                <a href="{{ route('student.notifikasi.index') }}" class="flex items-center gap-3 px-4 py-2 bg-purple-200 text-purple-700 rounded-lg font-bold text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.027 6.027 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    Notifikasi Belajar
                </a>
            </nav>
        </aside>

        <!-- Main Content Area Kanan (Lebar Dibatasi, Gak Melar Lagi!) -->
        <main class="ml-64 flex-1 overflow-auto bg-gray-50">
            <div class="p-8 max-w-4xl">
                
                <!-- Header Halaman -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Notifikasi Pengingat Belajar</h1>
                    <p class="text-gray-600 text-sm mt-2">Membantu Anda tetap konsisten mengikuti jadwal belajar yang telah disusun.</p>
                </div>

                <!-- Box Card List Notifikasi Bulat Halus Sesuai Gambar -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                    
                    <!-- Notifikasi 1 -->
                    <div class="p-4 rounded-xl bg-purple-50/60 border border-purple-100 flex items-start gap-4 transition hover:bg-purple-50">
                        <div class="p-3 bg-purple-100 text-purple-700 rounded-xl text-xl shrink-0 shadow-sm">
                            ⏰
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <h3 class="font-bold text-sm text-purple-900">Waktunya Belajar!</h3>
                                <span class="text-xs text-purple-500 font-medium">Baru saja</span>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">Sesuai dengan jadwal di Study Planner Anda, saat ini adalah sesi untuk materi <span class="font-bold text-purple-700">Kalkulus Lanjut (Kumpulan Soal 4)</span>. Yuk, semangat belajarnya!</p>
                        </div>
                    </div>

                    <!-- Notifikasi 2 -->
                    <div class="p-4 rounded-xl bg-white border border-gray-100 shadow-xs flex items-start gap-4 transition hover:bg-gray-50">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl text-xl shrink-0">
                            📚
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <h3 class="font-bold text-sm text-gray-900">Sesi Belajar Selesai</h3>
                                <span class="text-xs text-gray-400">2 jam yang lalu</span>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">Selamat! Anda telah menyelesaikan target belajar materi <span class="font-semibold text-gray-800">Makroekonomi</span> hari ini tepat waktu.</p>
                        </div>
                    </div>

                    <!-- Notifikasi 3 -->
                    <div class="p-4 rounded-xl bg-white border border-gray-100 shadow-xs flex items-start gap-4 transition hover:bg-gray-50">
                        <div class="p-3 bg-yellow-50 text-yellow-600 rounded-xl text-xl shrink-0">
                            ⚠️
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <h3 class="font-bold text-sm text-gray-900">Agenda Esok Hari</h3>
                                <span class="text-xs text-gray-400">Kemarin</span>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">Pengingat jadwal: Besok jam 10:00 WIB Anda memiliki agenda penting <span class="font-semibold text-gray-800">Persiapan Ujian (Sesi Simulasi #2)</span>.</p>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
</html>