<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Intellecta Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-purple-100 min-h-screen flex flex-col flex-shrink-0">
            <!-- Logo Area -->
            <div class="p-6">
                <h1 class="text-2xl font-bold text-purple-700">Intellecta</h1>
                <p class="text-xs text-purple-400 mt-1">Admin Panel</p>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-4 py-3 rounded-lg text-purple-600 hover:bg-purple-200 hover:text-purple-800 transition-all duration-200">
                    Dashboard
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
                <a href="{{ route('admin.news.index') }}" class="inline-flex items-center text-sm font-semibold text-purple-600 hover:text-purple-700 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Berita
                </a>
            </div>

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Berita</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui detail atau konten dari berita/pengumuman ini.</p>
            </div>

            <!-- Form Card Layout -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm max-w-2xl overflow-hidden mb-12">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-bold text-gray-700 mb-1.5">Judul Berita <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" required value="{{ old('title', $news->title) }}"
                                   placeholder="Contoh: Webinar Gratis: Meningkatkan Skill Data Analytics untuk Pemula"
                                   class="block w-full px-4 py-2.5 border @error('title') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">
                            @error('title')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-bold text-gray-700 mb-1.5">Isi Berita <span class="text-red-500">*</span></label>
                            <textarea name="content" id="content" rows="8" required
                                      placeholder="Tuliskan isi lengkap dari berita atau pengumuman di sini..."
                                      class="block w-full px-4 py-2.5 border @error('content') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Cover Image Preview -->
                        @if($news->image)
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">Gambar Cover Saat Ini</label>
                                <div class="w-32 h-32 rounded-xl overflow-hidden border border-gray-200">
                                    <img src="{{ asset('storage/' . $news->image) }}" alt="Current Cover" class="w-full h-full object-cover">
                                </div>
                            </div>
                        @endif

                        <!-- Image File -->
                        <div>
                            <label for="image" class="block text-sm font-bold text-gray-700 mb-1.5">Ubah Gambar Cover (Opsional)</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 border border-gray-200 rounded-xl p-2.5 hover:border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200">
                            <small class="text-gray-400 text-xs mt-1 block">Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
                            @error('image')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Published At -->
                        <div>
                            <label for="published_at" class="block text-sm font-bold text-gray-700 mb-1.5">Tanggal Publish (Opsional)</label>
                            <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}"
                                   class="block w-full px-4 py-2.5 border @error('published_at') border-red-300 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-300 transition-all duration-200">
                            <small class="text-gray-400 text-xs mt-1 block">Kosongkan jika ingin disimpan sebagai draft atau dipublish nanti.</small>
                            @error('published_at')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.news.index') }}" 
                               class="px-4 py-2.5 text-gray-500 hover:text-gray-700 font-semibold text-sm hover:bg-gray-50 rounded-xl transition-all duration-150">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-5 py-2.5 bg-purple-600 text-white font-semibold text-sm rounded-xl shadow-md hover:bg-purple-700 hover:shadow-lg hover:shadow-purple-500/20 active:scale-95 transition-all duration-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                Perbarui Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
