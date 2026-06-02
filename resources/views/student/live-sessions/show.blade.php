<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Sesi Kelas Live</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">Intellecta</div>
            <div class="sidebar-subtitle">Smart Learning</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('student.quizzes.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                        Kuis & Evaluasi
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('subscription.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.5 2C6.81 2 3 5.81 3 10.5S6.81 19 11.5 19h.5v3c4.86-2.34 8-7 8-11.5C20 5.81 16.19 2 11.5 2zm1 14.5h-2v-2h2v2zm0-4h-2c0-3.25 3-3 3-5 0-1.1-.9-2-2-2s-2 .9-2 2h-2c0-2.21 1.79-4 4-4s4 1.79 4 4c0 2.5-3 2.75-3 5z"/>
                        </svg>
                        Paket Belajar
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('student.videos.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/>
                        </svg>
                        Materi Video
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('student.live-schedule.index') }}" class="sidebar-menu-link active">
                        <svg class="sidebar-menu-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Kelas Live
                    </a>
                </li>
                <li class="sidebar-menu-item" style="margin-top: 2rem;">
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-menu-link" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer; color: #ef4444;">
                            <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24" style="color: #ef4444;">
                                <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Breadcrumbs -->
            <div class="mb-4">
                <a href="{{ route('student.live-schedule.index') }}" class="inline-flex items-center text-sm font-semibold text-purple-600 hover:text-purple-700 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Jadwal
                </a>
            </div>

            <!-- Toast Container -->
            <div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-2"></div>

            <!-- Page Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12 items-start">
                
                <!-- Main details (Col span 2) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Session Detail Card -->
                    <div class="bg-white rounded-3xl border border-purple-100/50 p-6 sm:p-8 shadow-sm">
                        <!-- Top Info -->
                        <div class="flex flex-wrap items-center gap-2.5 mb-5">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold border {{ $session->platform_badge_color }}">
                                {{ $session->platform_name }}
                            </span>

                            @if($session->status === 'live')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold tracking-wide bg-red-500 text-white animate-pulse">
                                    🔴 LIVE SEKARANG
                                </span>
                            @elseif($session->status === 'scheduled')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold tracking-wide bg-purple-100 text-purple-700">
                                    TERJADWAL
                                </span>
                            @endif
                        </div>

                        <!-- Title -->
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 leading-tight">
                            {{ $session->title }}
                        </h1>

                        <!-- Description -->
                        <div class="mt-6">
                            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-2">Deskripsi Kelas</h3>
                            <p class="text-sm text-gray-600 leading-relaxed bg-purple-50/20 p-4 rounded-2xl border border-purple-100/10">
                                {{ $session->description ?? 'Tidak ada deskripsi tambahan untuk kelas live ini.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Instructor Info -->
                    <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center text-2xl font-bold flex-shrink-0">
                            {{ substr($session->teacher->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-xs text-gray-400 font-bold uppercase tracking-wider">Instruktur Kelas</div>
                            <h4 class="text-base font-extrabold text-gray-900 mt-0.5">{{ $session->teacher->name }}</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Pengajar Resmi di Platform Intellecta</p>
                        </div>
                    </div>
                </div>

                <!-- Live Portal Join Card (Col span 1) -->
                <div class="space-y-6">
                    <div class="bg-gradient-to-b from-purple-900 to-indigo-950 text-white rounded-3xl p-6 sm:p-8 shadow-xl relative overflow-hidden">
                        
                        <!-- Overlay background art -->
                        <div class="absolute -right-16 -top-16 w-44 h-44 rounded-full bg-purple-500/10 blur-xl pointer-events-none"></div>
                        <div class="absolute -left-16 -bottom-16 w-44 h-44 rounded-full bg-indigo-500/10 blur-xl pointer-events-none"></div>

                        <h3 class="text-lg font-extrabold mb-4">Informasi Sesi</h3>
                        
                        <div class="space-y-4 text-xs font-semibold text-purple-200/90 mb-8">
                            <div class="flex items-center gap-3 p-3 bg-white/5 border border-white/10 rounded-2xl">
                                <span class="text-lg">📅</span>
                                <div>
                                    <div class="text-[10px] text-purple-300 uppercase tracking-wide">Hari & Tanggal</div>
                                    <div class="text-sm font-bold text-white mt-0.5">{{ $session->formatted_schedule }}</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-white/5 border border-white/10 rounded-2xl">
                                <span class="text-lg">⏱️</span>
                                <div>
                                    <div class="text-[10px] text-purple-300 uppercase tracking-wide">Durasi Sesi</div>
                                    <div class="text-sm font-bold text-white mt-0.5">{{ $session->duration_minutes }} Menit</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-white/5 border border-white/10 rounded-2xl">
                                <span class="text-lg">👥</span>
                                <div>
                                    <div class="text-[10px] text-purple-300 uppercase tracking-wide">Jumlah Kehadiran</div>
                                    <div class="text-sm font-bold text-white mt-0.5" id="attendance-count">{{ $session->attendances->count() }} Terdaftar</div>
                                </div>
                            </div>
                        </div>

                        <!-- Join Button Flow -->
                        @if($session->status === 'live')
                            <button id="join-btn" onclick="joinLiveClass()"
                                    class="w-full py-4 bg-red-500 hover:bg-red-600 text-white font-extrabold text-sm rounded-2xl shadow-lg hover:shadow-red-500/30 hover:scale-[1.02] active:scale-95 transition-all duration-300">
                                🚀 Masuk Kelas Sekarang
                            </button>
                            <p class="text-[10px] text-center text-red-200 mt-3 font-semibold">
                                *Sesi sudah berjalan! Klik tombol untuk membuka tautan kelas & mencatat kehadiran Anda.
                            </p>
                        @elseif($session->status === 'scheduled')
                            <button id="join-btn" onclick="joinLiveClass()"
                                    class="w-full py-4 bg-purple-600 hover:bg-purple-700 text-white font-extrabold text-sm rounded-2xl shadow-lg hover:shadow-purple-500/30 hover:scale-[1.02] active:scale-95 transition-all duration-300">
                                🚀 Masuk Kelas Sekarang
                            </button>
                            <p class="text-[10px] text-center text-purple-300/80 mt-3 font-semibold">
                                *Klik tombol untuk membuka tautan pertemuan & mencatat daftar kehadiran Anda secara otomatis.
                            </p>
                        @else
                            <button disabled
                                    class="w-full py-4 bg-gray-700 text-gray-500 font-extrabold text-sm rounded-2xl cursor-not-allowed transition-all duration-300">
                                🔒 Kelas Sudah Berakhir
                            </button>
                            <p class="text-[10px] text-center text-gray-500 mt-3 font-semibold">
                                Sesi kelas live ini sudah berakhir atau telah dibatalkan oleh instruktur.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="dashboard-footer">
                <div>
                    <div class="footer-logo">Intellecta</div>
                    <div>© 2024 Intellecta Indonesia, Learning Hub CPDI Sai Universitas Urbanus</div>
                </div>
                <div class="footer-links">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Layanan</a>
                    <a href="#">Hubungi Dukungan</a>
                </div>
            </footer>
        </main>
    </div>

    <!-- Attendance & Join AJAX Javascript -->
    <script>
        let isJoining = false;

        function joinLiveClass() {
            if (isJoining) return;
            isJoining = true;

            const btn = document.getElementById('join-btn');
            const originalText = btn.innerHTML;
            btn.innerHTML = '🔄 Memproses Kehadiran...';
            btn.disabled = true;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Send AJAX request to record attendance and retrieve meeting link
            fetch("{{ route('student.live-sessions.join', $session) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                }
            })
            .then(async response => {
                const data = await response.json();
                
                if (response.ok && data.success) {
                    showToast("Kehadiran Anda berhasil dicatat! 🎓 Mengalihkan ke kelas live...");
                    
                    // Update attendance label count
                    const countEl = document.getElementById('attendance-count');
                    if (countEl && data.attendance_count) {
                        countEl.innerText = `${data.attendance_count} Terdaftar`;
                    }

                    // Open meeting link in a new tab
                    setTimeout(() => {
                        window.open(data.meeting_link, '_blank');
                        
                        // Reset button
                        btn.innerHTML = '✅ Berhasil Bergabung';
                        btn.classList.remove('bg-purple-600', 'hover:bg-purple-700', 'bg-red-500', 'hover:bg-red-600');
                        btn.classList.add('bg-emerald-600');
                        isJoining = false;
                    }, 1000);

                } else {
                    showToast(data.message || "Gagal mencatat kehadiran kelas. Silakan coba lagi.", "error");
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    isJoining = false;
                }
            })
            .catch(err => {
                showToast("Terjadi kesalahan jaringan. Periksa koneksi Anda.", "error");
                btn.innerHTML = originalText;
                btn.disabled = false;
                isJoining = false;
            });
        }

        function showToast(message, type = "success") {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            toast.className = `flex items-center gap-2.5 px-4 py-3 rounded-xl border shadow-lg text-sm font-semibold transition-all duration-300 transform translate-y-2 opacity-0 max-w-sm ${
                type === "success" 
                    ? "bg-purple-600 text-white border-purple-500" 
                    : "bg-red-600 text-white border-red-500"
            }`;
            
            toast.innerHTML = `
                <svg class="w-4 h-4 text-white flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4"/>
                </svg>
                <span>${message}</span>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('translate-y-2', 'opacity-0');
            }, 10);

            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-[-10px]');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 4000);
        }
    </script>
</body>
</html>
