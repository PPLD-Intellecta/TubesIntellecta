<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Intellecta Admin</title>
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
            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Kelola Berita</h2>
                        <p class="text-gray-500 mt-1">Kelola konten berita dan pengumuman untuk siswa</p>
                    </div>
                    <a href="{{ route('admin.news.create') }}" 
                       class="inline-flex items-center justify-center px-5 py-3 bg-purple-600 text-white font-bold text-sm rounded-xl shadow-md hover:bg-purple-700 hover:shadow-lg hover:shadow-purple-500/20 active:scale-95 transition-all duration-200 gap-2 self-start sm:self-auto">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Berita
                    </a>
                </div>
            </div>

            <!-- Laravel Session Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif
            
            <!-- Search Bar -->
            <div class="mb-6 relative max-w-md w-full">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="h-4.5 w-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input type="text" id="news-search"
                       placeholder="Cari berita berdasarkan judul..."
                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl 
                              focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent
                              hover:border-purple-300 transition-all duration-200 text-sm">
            </div>
            
            <!-- News List Container -->
            <div class="space-y-4" id="news-list">
                @forelse($news as $item)
                    <!-- News Card Item -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-6 
                                hover:shadow-lg hover:border-purple-200 
                                transition-all duration-300 news-card"
                         data-title="{{ strtolower($item->title) }}">
                        
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                            <div class="flex-1 min-w-0 flex gap-4">
                                @if($item->image)
                                    <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-24 h-24 rounded-xl flex-shrink-0 bg-gradient-to-br from-purple-50 to-purple-100 flex items-center justify-center text-3xl">
                                        📰
                                    </div>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 truncate" title="{{ $item->title }}">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="text-gray-500 text-sm mb-4 line-clamp-2 leading-relaxed">
                                        {{ Str::limit(strip_tags($item->content), 180) }}
                                    </p>
                                    
                                    <div class="flex items-center gap-4 text-xs text-gray-400 font-semibold">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2v3m2-3V9m-2 4h.01m-6.99 3h3.01M9 12h3.01m-9-3h12a2 2 0 012 2v6a2 2 0 01-2 2H3a2 2 0 01-2-2V9a2 2 0 012-2z"/>
                                            </svg>
                                            Berita
                                        </span>
                                        <span>•</span>
                                        <span class="text-purple-600">
                                            {{ $item->published_at ? $item->published_at->format('d M Y H:i') : 'Draft' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-2.5 ml-0 md:ml-6 flex-shrink-0">
                                <a href="{{ route('student.news.show', $item->id) }}" target="_blank"
                                   class="px-4 py-2 bg-purple-50 text-purple-700 font-bold text-xs rounded-xl 
                                          hover:bg-purple-100 transition-all duration-200">
                                    Lihat
                                </a>
                                <a href="{{ route('admin.news.edit', $item->id) }}"
                                   class="px-4 py-2 bg-gray-100 text-gray-700 font-bold text-xs rounded-xl 
                                          hover:bg-gray-200 transition-all duration-200">
                                    Edit
                                </a>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-4 py-2 bg-red-50 text-red-600 font-bold text-xs rounded-xl 
                                                   hover:bg-red-100 transition-all duration-200">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State (if no news) -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center shadow-sm">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2v3m2-3V9m-2 4h.01m-6.99 3h3.01M9 12h3.01m-9-3h12a2 2 0 012 2v6a2 2 0 01-2 2H3a2 2 0 01-2-2V9a2 2 0 012-2z"/>
                        </svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada berita</h3>
                        <p class="text-gray-500 mb-6 text-sm">Mulai tambahkan berita atau pengumuman baru untuk siswa Anda.</p>
                        <a href="{{ route('admin.news.create') }}" 
                           class="inline-flex items-center justify-center px-5 py-3 bg-purple-600 text-white font-bold text-sm rounded-xl shadow-md hover:bg-purple-700 transition-all duration-200">
                            Tambah Berita Pertama
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Client-Side No Results Found -->
            <div id="search-empty" class="bg-white rounded-2xl border border-gray-200 p-12 text-center shadow-sm hidden">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Berita tidak ditemukan</h3>
                <p class="text-gray-500 text-sm">Tidak ada berita yang cocok dengan kata kunci pencarian Anda.</p>
            </div>
            
            @if($news->hasPages())
                <div class="mt-6">
                    {{ $news->links() }}
                </div>
            @endif
        </main>
    </div>

    <!-- Client-Side Search Javascript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('news-search');
            const cards = document.querySelectorAll('.news-card');
            const searchEmpty = document.getElementById('search-empty');

            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();
                    let hasMatch = false;

                    cards.forEach(card => {
                        const title = card.getAttribute('data-title');
                        if (title.includes(query)) {
                            card.style.display = '';
                            hasMatch = true;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Manage empty states
                    if (!hasMatch && cards.length > 0) {
                        searchEmpty.classList.remove('hidden');
                    } else {
                        searchEmpty.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>
