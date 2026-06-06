<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Kelola Kelas Live</title>
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
            <div class="sidebar-subtitle">Teacher Panel</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item"><a href="{{ route('teacher.quizzes.index') }}" class="sidebar-menu-link">Kelola Kuis</a></li>
                <li class="sidebar-menu-item"><a href="{{ route('teacher.live-sessions.index') }}" class="sidebar-menu-link active">Kelas Live</a></li>
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
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Jadwal Kelas Live</h1>
                    <p class="text-sm text-gray-500 mt-1">Jadwalkan pertemuan tatap muka online dan bagikan tautan kepada siswa Anda.</p>
                </div>
                <a href="{{ route('teacher.live-sessions.create') }}" 
                   class="inline-flex items-center justify-center px-4 py-2.5 bg-purple-600 text-white font-semibold text-sm rounded-xl shadow-md hover:bg-purple-700 hover:shadow-lg hover:shadow-purple-500/20 active:scale-95 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    + Buat Kelas Baru
                </a>
            </div>

            <!-- Toast Container -->
            <div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-2"></div>

            <!-- Laravel Session Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Sessions List Card -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-gray-50/50">
                    <h2 class="text-base font-bold text-gray-800">Daftar Pertemuan Kelas</h2>
                    <div class="relative max-w-xs w-full">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text" id="search-input" placeholder="Cari berdasarkan judul..." 
                               class="block w-full pl-9 pr-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse" id="sessions-table">
                        <thead>
                            <tr class="border-b border-gray-100 text-xs font-bold text-gray-500 uppercase bg-gray-50/20">
                                <th class="px-6 py-4">Judul Kelas</th>
                                <th class="px-6 py-4">Platform</th>
                                <th class="px-6 py-4">Jadwal Kelas (WIB)</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($sessions as $session)
                                <tr class="hover:bg-purple-50/30 transition-colors duration-150 session-row" data-title="{{ strtolower($session->title) }}">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900 text-sm max-w-xs truncate" title="{{ $session->title }}">
                                            {{ $session->title }}
                                        </div>
                                        @if($session->description)
                                            <div class="text-xs text-gray-400 mt-0.5 line-clamp-1 max-w-xs" title="{{ $session->description }}">
                                                {{ $session->description }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold border {{ $session->platform_badge_color }}">
                                            {{ $session->platform_name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <div>{{ $session->formatted_schedule }}</div>
                                        <div class="text-xs text-gray-400 mt-0.5">Durasi: {{ $session->duration_minutes }} menit</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($session->status === 'live')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-600 animate-pulse">
                                                ● LIVE
                                            </span>
                                        @elseif($session->status === 'scheduled')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                                                Terjadwal
                                            </span>
                                        @elseif($session->status === 'ended')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">
                                                Selesai
                                            </span>
                                        @elseif($session->status === 'cancelled')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-500 border border-red-100">
                                                Dibatalkan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-50 text-yellow-700 border border-yellow-100">
                                                Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2.5">
                                            <!-- Copy Link Button -->
                                            <button onclick="copyToClipboard('{{ $session->meeting_link }}')" 
                                                    title="Salin Tautan"
                                                    class="p-2 text-gray-400 hover:text-purple-600 hover:bg-purple-50 rounded-lg hover:scale-105 active:scale-95 transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                                                </svg>
                                            </button>

                                            <!-- Edit Button -->
                                            <a href="{{ route('teacher.live-sessions.edit', $session) }}" 
                                               title="Edit Kelas"
                                               class="p-2 text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg hover:scale-105 active:scale-95 transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('teacher.live-sessions.destroy', $session) }}" method="POST" 
                                                  class="inline-block" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas live ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        title="Hapus Kelas"
                                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg hover:scale-105 active:scale-95 transition-all duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-state">
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        <div class="text-4xl mb-2">📅</div>
                                        <div class="font-bold text-gray-700">Belum ada kelas live</div>
                                        <div class="text-xs mt-1 text-gray-400 max-w-sm mx-auto">Anda belum menjadwalkan kelas live apa pun. Klik "+ Buat Kelas Baru" untuk memulai!</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <footer class="dashboard-footer mt-12">
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

    <!-- Clipboard & Toast Notifications JS -->
    <script>
        function copyToClipboard(link) {
            navigator.clipboard.writeText(link).then(() => {
                showToast("Tautan berhasil disalin ke papan klip! 📋");
            }).catch(err => {
                showToast("Gagal menyalin tautan. Silakan salin manual.", "error");
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

            // Trigger animation
            setTimeout(() => {
                toast.classList.remove('translate-y-2', 'opacity-0');
            }, 10);

            // Remove toast after delay
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-[-10px]');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }

        // Live Search Filter
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search-input');
            const rows = document.querySelectorAll('.session-row');
            
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();
                    let hasVisibleRow = false;

                    rows.forEach(row => {
                        const title = row.getAttribute('data-title');
                        if (title.includes(query)) {
                            row.style.display = '';
                            hasVisibleRow = true;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Manage empty state if there's no result
                    let emptyState = document.getElementById('search-empty');
                    if (!hasVisibleRow && query.length > 0) {
                        if (!emptyState) {
                            emptyState = document.createElement('tr');
                            emptyState.id = 'search-empty';
                            emptyState.innerHTML = `
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                    <div class="text-xl">🔍</div>
                                    <div class="font-semibold mt-1">Kelas tidak ditemukan</div>
                                    <div class="text-xs text-gray-400">Tidak ada kelas live yang cocok dengan pencarian Anda.</div>
                                </td>
                            `;
                            document.querySelector('#sessions-table tbody').appendChild(emptyState);
                        }
                    } else if (emptyState) {
                        emptyState.remove();
                    }
                });
            }
        });
    </script>
</body>
</html>
