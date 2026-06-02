<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Buat Kelas Live</title>
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
            <!-- Breadcrumbs -->
            <div class="mb-4">
                <a href="{{ route('teacher.live-sessions.index') }}" class="inline-flex items-center text-sm font-semibold text-purple-600 hover:text-purple-700 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Jadwal
                </a>
            </div>

            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Buat Jadwal Kelas Live</h1>
                <p class="text-sm text-gray-500 mt-1">Jadwalkan kelas interaktif tatap muka online baru untuk para siswa.</p>
            </div>

            <!-- Form Card Layout -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm max-w-2xl overflow-hidden mb-12">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('teacher.live-sessions.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-bold text-gray-700 mb-1.5">Judul Kelas Live <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" required value="{{ old('title') }}"
                                   placeholder="Contoh: Belajar UI/UX Lanjutan dengan Figma"
                                   class="block w-full px-4 py-2.5 border @error('title') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">
                            @error('title')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-1.5">Deskripsi Kelas (Opsional)</label>
                            <textarea name="description" id="description" rows="4"
                                      placeholder="Jelaskan apa saja yang akan dipelajari di kelas live ini..."
                                      class="block w-full px-4 py-2.5 border @error('description') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Platform selection -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Platform Pertemuan <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <label class="relative flex items-center justify-center p-3 rounded-xl border border-gray-200 cursor-pointer hover:border-purple-200 hover:bg-purple-50/10 active:scale-95 transition-all duration-150">
                                    <input type="radio" name="platform" value="google_meet" required {{ old('platform') == 'google_meet' ? 'checked' : '' }} class="sr-only peer">
                                    <div class="text-center peer-checked:text-purple-600">
                                        <div class="text-xl mb-0.5">🟢</div>
                                        <div class="text-xs font-bold">Google Meet</div>
                                    </div>
                                    <div class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-purple-600 pointer-events-none"></div>
                                </label>

                                <label class="relative flex items-center justify-center p-3 rounded-xl border border-gray-200 cursor-pointer hover:border-purple-200 hover:bg-purple-50/10 active:scale-95 transition-all duration-150">
                                    <input type="radio" name="platform" value="zoom" {{ old('platform', 'zoom') == 'zoom' ? 'checked' : '' }} class="sr-only peer">
                                    <div class="text-center peer-checked:text-purple-600">
                                        <div class="text-xl mb-0.5">🔵</div>
                                        <div class="text-xs font-bold">Zoom</div>
                                    </div>
                                    <div class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-purple-600 pointer-events-none"></div>
                                </label>

                                <label class="relative flex items-center justify-center p-3 rounded-xl border border-gray-200 cursor-pointer hover:border-purple-200 hover:bg-purple-50/10 active:scale-95 transition-all duration-150">
                                    <input type="radio" name="platform" value="microsoft_teams" {{ old('platform') == 'microsoft_teams' ? 'checked' : '' }} class="sr-only peer">
                                    <div class="text-center peer-checked:text-purple-600">
                                        <div class="text-xl mb-0.5">🟣</div>
                                        <div class="text-xs font-bold">MS Teams</div>
                                    </div>
                                    <div class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-purple-600 pointer-events-none"></div>
                                </label>

                                <label class="relative flex items-center justify-center p-3 rounded-xl border border-gray-200 cursor-pointer hover:border-purple-200 hover:bg-purple-50/10 active:scale-95 transition-all duration-150">
                                    <input type="radio" name="platform" value="other" {{ old('platform') == 'other' ? 'checked' : '' }} class="sr-only peer">
                                    <div class="text-center peer-checked:text-purple-600">
                                        <div class="text-xl mb-0.5">🔗</div>
                                        <div class="text-xs font-bold">Lainnya</div>
                                    </div>
                                    <div class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-purple-600 pointer-events-none"></div>
                                </label>
                            </div>
                            @error('platform')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Meeting Link -->
                        <div>
                            <label for="meeting_link" class="block text-sm font-bold text-gray-700 mb-1.5">Tautan Pertemuan (URL Link) <span class="text-red-500">*</span></label>
                            <input type="url" name="meeting_link" id="meeting_link" required value="{{ old('meeting_link') }}"
                                   placeholder="Contoh: https://meet.google.com/abc-defg-hij atau https://zoom.us/j/..."
                                   class="block w-full px-4 py-2.5 border @error('meeting_link') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">
                            @error('meeting_link')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Scheduled At -->
                            <div>
                                <label for="scheduled_at" class="block text-sm font-bold text-gray-700 mb-1.5">Waktu Mulai (WIB) <span class="text-red-500">*</span></label>
                                <input type="datetime-local" name="scheduled_at" id="scheduled_at" required value="{{ old('scheduled_at') }}"
                                       class="block w-full px-4 py-2.5 border @error('scheduled_at') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">
                                <p class="text-[10px] text-gray-400 mt-1 font-medium">Zona Waktu: Asia/Jakarta (WIB)</p>
                                @error('scheduled_at')
                                    <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Duration -->
                            <div>
                                <label for="duration_minutes" class="block text-sm font-bold text-gray-700 mb-1.5">Durasi Kelas <span class="text-red-500">*</span></label>
                                <select name="duration_minutes" id="duration_minutes" required
                                        class="block w-full px-4 py-2.5 border @error('duration_minutes') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">
                                    <option value="30" {{ old('duration_minutes') == '30' ? 'selected' : '' }}>30 Menit</option>
                                    <option value="45" {{ old('duration_minutes') == '45' ? 'selected' : '' }}>45 Menit</option>
                                    <option value="60" {{ old('duration_minutes') == '60' || !old('duration_minutes') ? 'selected' : '' }}>60 Menit (1 Jam)</option>
                                    <option value="90" {{ old('duration_minutes') == '90' ? 'selected' : '' }}>90 Menit (1.5 Jam)</option>
                                    <option value="120" {{ old('duration_minutes') == '120' ? 'selected' : '' }}>120 Menit (2 Jam)</option>
                                    <option value="180" {{ old('duration_minutes') == '180' ? 'selected' : '' }}>180 Menit (3 Jam)</option>
                                </select>
                                @error('duration_minutes')
                                    <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Max Participants -->
                        <div>
                            <label for="max_participants" class="block text-sm font-bold text-gray-700 mb-1.5">Kuota Peserta Maksimal (Opsional)</label>
                            <input type="number" name="max_participants" id="max_participants" min="1" value="{{ old('max_participants') }}"
                                   placeholder="Kosongkan jika tidak dibatasi"
                                   class="block w-full px-4 py-2.5 border @error('max_participants') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">
                            @error('max_participants')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('teacher.live-sessions.index') }}" 
                               class="px-4 py-2.5 text-gray-500 hover:text-gray-700 font-semibold text-sm hover:bg-gray-50 rounded-xl transition-all duration-150">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-5 py-2.5 bg-purple-600 text-white font-semibold text-sm rounded-xl shadow-md hover:bg-purple-700 hover:shadow-lg hover:shadow-purple-500/20 active:scale-95 transition-all duration-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Jadwal
                            </button>
                        </div>
                    </form>
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
</body>
</html>
