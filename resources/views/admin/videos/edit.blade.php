<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Video - Intellecta Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-purple-100 min-h-screen flex flex-col flex-shrink-0">
            <!-- Logo Area -->
            <div class="p-6">
                <h1 class="text-2xl font-bold text-purple-700">Intellecta</h1>
                <p class="text-xs text-purple-400 mt-1">Teacher Panel</p>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-4 py-3 rounded-lg text-purple-600 hover:bg-purple-200 hover:text-purple-800 transition-all duration-200">
                    Dashboard
                </a>
                <a href="{{ route('admin.videos.index') }}" 
                   class="block px-4 py-3 rounded-lg bg-purple-200 text-purple-800 font-semibold transition-all duration-200">
                    Manajemen Video
                </a>
            </nav>
            
            <!-- Logout -->
            <div class="p-4 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center gap-2 px-4 py-3 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-600 transition-all duration-200 text-left">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="font-semibold text-sm">Logout</span>
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            <!-- Breadcrumbs -->
            <div class="mb-4">
                <a href="{{ route('admin.videos.index') }}" class="inline-flex items-center text-sm font-semibold text-purple-600 hover:text-purple-700 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Video
                </a>
            </div>

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Video</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui detail atau deskripsi materi video pembelajaran ini.</p>
            </div>

            <!-- Form Card Layout -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm max-w-2xl overflow-hidden mb-12">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-bold text-gray-700 mb-1.5">Judul Video <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" required value="{{ old('title', $video->title) }}"
                                   placeholder="Contoh: Figma Masterclass: Pengenalan Design System"
                                   class="block w-full px-4 py-2.5 border @error('title') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">
                            @error('title')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="4" required
                                      placeholder="Jelaskan secara singkat apa saja yang akan dipelajari di video ini..."
                                      class="block w-full px-4 py-2.5 border @error('description') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">{{ old('description', $video->description) }}</textarea>
                            @error('description')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL Video -->
                        <div>
                            <label for="url_video" class="block text-sm font-bold text-gray-700 mb-1.5">URL Video (YouTube / GDrive) <span class="text-red-500">*</span></label>
                            <input type="url" name="url_video" id="url_video" required value="{{ old('url_video', $video->url_video) }}"
                                   placeholder="Contoh: https://www.youtube.com/watch?v=..."
                                   class="block w-full px-4 py-2.5 border @error('url_video') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">
                            @error('url_video')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.videos.index') }}" 
                               class="px-4 py-2.5 text-gray-500 hover:text-gray-700 font-semibold text-sm hover:bg-gray-50 rounded-xl transition-all duration-150">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-5 py-2.5 bg-purple-600 text-white font-semibold text-sm rounded-xl shadow-md hover:bg-purple-700 hover:shadow-lg hover:shadow-purple-500/20 active:scale-95 transition-all duration-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                Perbarui Video
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
