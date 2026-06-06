<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Jadwal Kelas Live</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
                <li class="sidebar-menu-item">
                    <a href="{{ route('student.planner.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Study Planner
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
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Jadwal Kelas Live</h1>
                <p class="text-sm text-gray-500 mt-1">Ikuti sesi pembelajaran tatap muka online secara langsung bersama instruktur ahli kami.</p>
            </div>

            <!-- Filter Tabs -->
            <div class="flex flex-wrap gap-2.5 mb-8 border-b border-gray-100 pb-4">
                <a href="{{ route('student.live-schedule.index', ['tab' => 'all']) }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-200 {{ $tab === 'all' ? 'bg-purple-600 text-white shadow-md shadow-purple-500/20' : 'bg-purple-50 text-purple-700 hover:bg-purple-100' }}">
                    Semua Kelas
                </a>
                <a href="{{ route('student.live-schedule.index', ['tab' => 'live']) }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-200 {{ $tab === 'live' ? 'bg-red-500 text-white shadow-md shadow-red-500/20' : 'bg-red-50 text-red-600 hover:bg-red-100' }}">
                    🔴 Sedang LIVE
                </a>
                <a href="{{ route('student.live-schedule.index', ['tab' => 'upcoming']) }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-200 {{ $tab === 'upcoming' ? 'bg-purple-600 text-white shadow-md shadow-purple-500/20' : 'bg-purple-50 text-purple-700 hover:bg-purple-100' }}">
                    Akan Datang
                </a>
                <a href="{{ route('student.live-schedule.index', ['tab' => 'past']) }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-200 {{ $tab === 'past' ? 'bg-purple-600 text-white shadow-md shadow-purple-500/20' : 'bg-purple-50 text-purple-700 hover:bg-purple-100' }}">
                    Sudah Selesai
                </a>
            </div>

            <!-- Schedule Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @forelse($sessions as $session)
                    <!-- Session Card -->
                    <div onclick="window.location='{{ route('student.live-sessions.show', $session) }}'"
                         class="bg-white rounded-2xl border border-purple-100/50 shadow-sm hover:shadow-xl hover:shadow-purple-500/5 hover:-translate-y-1 transition-all duration-300 cursor-pointer overflow-hidden flex flex-col group relative">
                        
                        <!-- Top Badges -->
                        <div class="px-5 pt-5 pb-3 flex items-center justify-between gap-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-extrabold tracking-wide uppercase border {{ $session->platform_badge_color }}">
                                {{ $session->platform_name }}
                            </span>

                            @if($session->status === 'live')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold tracking-wide bg-red-500 text-white animate-pulse">
                                    🔴 LIVE NOW
                                </span>
                            @elseif($session->status === 'scheduled')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold tracking-wide bg-purple-100 text-purple-700">
                                    AKAN DATANG
                                </span>
                            @elseif($session->status === 'ended')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold tracking-wide bg-gray-100 text-gray-500">
                                    SELESAI
                                </span>
                            @elseif($session->status === 'cancelled')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold tracking-wide bg-red-50 text-red-500 border border-red-100">
                                    DIBATALKAN
                                </span>
                            @endif
                        </div>

                        <!-- Middle Content -->
                        <div class="px-5 pb-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-base font-extrabold text-gray-900 group-hover:text-purple-600 transition-colors line-clamp-2" title="{{ $session->title }}">
                                    {{ $session->title }}
                                </h3>

                                <div class="mt-3 space-y-2 text-xs text-gray-500 font-medium">
                                    <!-- Teacher Name -->
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm">👤</span>
                                        <span>Instruktur: <strong class="text-gray-700 font-semibold">{{ $session->teacher->name }}</strong></span>
                                    </div>
                                    
                                    <!-- Date Time -->
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm">📅</span>
                                        <span class="text-gray-700 font-semibold">{{ $session->formatted_schedule }}</span>
                                    </div>

                                    <!-- Duration -->
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm">⏱️</span>
                                        <span>Durasi Sesi: <strong class="text-gray-700 font-semibold">{{ $session->duration_minutes }} Menit</strong></span>
                                    </div>
                                </div>

                                @if($session->description)
                                    <p class="text-xs text-gray-400 mt-3.5 line-clamp-2">{{ $session->description }}</p>
                                @endif
                            </div>

                            <!-- Bottom Info -->
                            <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between gap-4">
                                <div class="text-xs text-gray-400 font-medium flex items-center gap-1.5">
                                    <span>👥</span>
                                    <span>
                                        <strong class="text-purple-600 font-bold">{{ $session->attendances->count() }}</strong>
                                        @if($session->max_participants)
                                            / {{ $session->max_participants }} Siswa
                                        @else
                                            Siswa bergabung
                                        @endif
                                    </span>
                                </div>

                                <!-- Join Button (visual states) -->
                                @if($session->status === 'live')
                                    <span class="inline-flex items-center justify-center px-4 py-2 bg-red-500 text-white font-bold text-xs rounded-xl shadow-md group-hover:bg-red-600 group-hover:shadow-lg group-hover:shadow-red-500/20 transition-all duration-200">
                                        Masuk Kelas
                                    </span>
                                @elseif($session->status === 'scheduled')
                                    <span class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 text-white font-bold text-xs rounded-xl shadow-md group-hover:bg-purple-700 group-hover:shadow-lg group-hover:shadow-purple-500/20 transition-all duration-200">
                                        Detail Kelas
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-400 font-bold text-xs rounded-xl cursor-not-allowed transition-all duration-200">
                                        Berakhir
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full py-16 text-center text-gray-400 bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <div class="text-5xl mb-2">📭</div>
                        <h3 class="font-bold text-gray-700 text-base">Tidak ada kelas live</h3>
                        <p class="text-xs text-gray-400 mt-1 max-w-sm mx-auto">Saat ini belum ada jadwal kelas live untuk kategori filter yang Anda pilih. Coba cek lagi nanti!</p>
                    </div>
                @endforelse
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
</body>
</html>
