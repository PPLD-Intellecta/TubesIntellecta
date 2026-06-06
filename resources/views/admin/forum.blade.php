<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Moderasi Forum</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />
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
                <p class="text-sm text-purple-900">2024 Akademi 2024</p>
            </div>

            <!-- Navigation -->
            <nav class="space-y-3 mb-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.videos.index') }}" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>
                    Manajemen Video
                </a>
                <a href="{{ route('admin.forum.index') }}" class="flex items-center gap-3 px-4 py-2 bg-purple-200 text-purple-700 rounded-lg font-medium text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10c.55 0 1-.45 1-1z"/></svg>
                    Moderasi Forum
                </a>
            </nav>

            <!-- Footer Links -->
            <div class="border-t border-purple-200 mt-auto pt-6 space-y-3">
                <a href="#" class="block text-sm text-purple-700 hover:text-purple-900">🤝 Pusat Bantuan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left text-sm text-purple-700 hover:text-purple-900">🚪 Keluar</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 overflow-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Moderasi Forum 💬</h1>
                    <p class="text-gray-600 text-sm mt-2">Kelola dan moderasi seluruh topik diskusi dan pesan dalam forum Intellecta</p>
                </div>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-6 text-sm font-semibold">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <!-- Stats Cards -->
                <div class="grid grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-purple-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-xl">📋</div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">{{ $forums->count() }}</div>
                                <div class="text-sm text-gray-500">Total Topik</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-purple-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-xl">💬</div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">{{ $forums->sum('chats_count') }}</div>
                                <div class="text-sm text-gray-500">Total Pesan</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-purple-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-xl">👥</div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">{{ $forums->pluck('user_id')->unique()->count() }}</div>
                                <div class="text-sm text-gray-500">Pembuat Forum</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Forum List -->
                <div class="bg-white rounded-xl shadow-sm border border-purple-100">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-900">Daftar Forum</h2>
                        <p class="text-sm text-gray-500 mt-1">Klik pada forum untuk melihat dan memoderasi pesan di dalamnya</p>
                    </div>

                    @forelse($forums as $forum)
                        <div class="border-b border-gray-50 last:border-0" x-data="{ open: false }">
                            <!-- Forum Row -->
                            <div class="p-6 hover:bg-purple-50/50 transition cursor-pointer" onclick="toggleForum('forum-{{ $forum->id }}')">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 flex-1">
                                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-content-center text-lg font-bold text-purple-700 items-center justify-center">
                                            {{ strtoupper(substr($forum->title, 0, 1)) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-bold text-gray-900 truncate">{{ $forum->title }}</div>
                                            <div class="text-sm text-gray-500 mt-0.5">
                                                Oleh <span class="font-semibold">{{ $forum->user->name ?? 'Unknown' }}</span>
                                                · {{ $forum->created_at->diffForHumans() }}
                                                · {{ $forum->chats_count }} pesan
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">
                                            {{ $forum->chats_count }} 💬
                                        </span>

                                        <!-- Delete Forum -->
                                        <form method="POST" action="{{ route('admin.forum.destroy', $forum) }}" onsubmit="return confirm('Yakin hapus forum ini beserta semua pesannya?')" onclick="event.stopPropagation();">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition">
                                                🗑️ Hapus Forum
                                            </button>
                                        </form>

                                        <svg class="w-5 h-5 text-gray-400 transition" id="arrow-forum-{{ $forum->id }}" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 10l5 5 5-5z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Expandable Chat List -->
                            <div class="hidden bg-gray-50 border-t border-gray-100" id="forum-{{ $forum->id }}">
                                <div class="p-6">
                                    <h3 class="text-sm font-bold text-gray-700 mb-4">Pesan dalam forum ini:</h3>

                                    @php
                                        $chats = \App\Models\Chat::where('forum_id', $forum->id)->with('user')->latest()->get();
                                    @endphp

                                    @forelse($chats as $chat)
                                        <div class="flex items-start gap-3 mb-4 p-3 bg-white rounded-xl border border-gray-100">
                                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-xs font-bold text-purple-700 flex-shrink-0">
                                                {{ strtoupper(substr($chat->user->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="text-sm font-bold text-gray-900">{{ $chat->user->name ?? 'Unknown' }}</span>
                                                    @if($chat->user->role === 'teacher')
                                                        <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-[10px] font-bold">Pengajar</span>
                                                    @elseif($chat->user->role === 'admin')
                                                        <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 rounded-full text-[10px] font-bold">Admin</span>
                                                    @endif
                                                    <span class="text-xs text-gray-400">{{ $chat->created_at->format('d M Y, H:i') }}</span>
                                                </div>
                                                <p class="text-sm text-gray-700">{{ $chat->message }}</p>
                                            </div>

                                            <!-- Delete Chat -->
                                            <form method="POST" action="{{ route('admin.forum.chat.destroy', $chat) }}" onsubmit="return confirm('Hapus pesan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 bg-red-50 text-red-500 hover:bg-red-100 rounded-lg text-xs font-bold transition flex-shrink-0">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    @empty
                                        <div class="text-center py-6 text-gray-400 text-sm">
                                            Belum ada pesan di forum ini
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="text-4xl mb-4">💬</div>
                            <div class="text-lg font-bold text-gray-700 mb-2">Belum Ada Forum</div>
                            <div class="text-sm text-gray-500">Forum diskusi yang dibuat oleh pengguna akan muncul di sini</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleForum(id) {
            const el = document.getElementById(id);
            const arrow = document.getElementById('arrow-' + id);
            if (el.classList.contains('hidden')) {
                el.classList.remove('hidden');
                if (arrow) arrow.style.transform = 'rotate(180deg)';
            } else {
                el.classList.add('hidden');
                if (arrow) arrow.style.transform = 'rotate(0deg)';
            }
        }
    </script>
</body>
</html>
