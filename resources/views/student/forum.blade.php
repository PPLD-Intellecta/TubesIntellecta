<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Forum Diskusi</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/forum.css') }}">
</head>
<body>
    <div class="forum-container">
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
                    <a href="{{ route('forum.index') }}" class="sidebar-menu-link active">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10c.55 0 1-.45 1-1z"/>
                        </svg>
                        Forum Diskusi
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
        <main class="forum-main">
            <!-- Header -->
            <div class="forum-header">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <div class="forum-header-top">
                    <div>
                        <h1 class="forum-title">Diskusi Komunitas 💬</h1>
                        <p class="forum-subtitle">Bergabung dalam percakapan dengan sesama siswa dan pengajar</p>
                    </div>
                    <button class="btn-primary" onclick="document.getElementById('createForumModal').classList.add('active')">
                        + Buat Topik Baru
                    </button>
                </div>
            </div>

            <!-- Layout -->
            <div class="forum-layout">
                <!-- Forum List -->
                <div class="forum-list">
                    @forelse($forums as $forum)
                        <a href="{{ route('forum.show', $forum) }}" class="forum-card" id="forum-card-{{ $forum->id }}">
                            <div class="forum-card-header">
                                <h3 class="forum-card-title">{{ $forum->title }}</h3>
                                <span class="forum-card-badge">{{ $forum->chats_count }} pesan</span>
                            </div>

                            @if($forum->description)
                                <p class="forum-card-description">{{ $forum->description }}</p>
                            @endif

                            <div class="forum-card-meta">
                                <div class="forum-card-meta-item">
                                    <div class="forum-card-avatar">
                                        {{ strtoupper(substr($forum->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span>{{ $forum->user->name ?? 'Unknown' }}</span>
                                </div>
                                <div class="forum-card-meta-item">
                                    <span>🕐</span>
                                    <span>{{ $forum->created_at->diffForHumans() }}</span>
                                </div>
                                @if($forum->user->role === 'teacher')
                                    <span style="background: #dbeafe; color: #1d4ed8; padding: 0.2rem 0.5rem; border-radius: 999px; font-size: 0.68rem; font-weight: 700;">Pengajar</span>
                                @elseif($forum->user->role === 'admin')
                                    <span style="background: #fef3c7; color: #92400e; padding: 0.2rem 0.5rem; border-radius: 999px; font-size: 0.68rem; font-weight: 700;">Admin</span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="empty-state">
                            <div class="empty-state-icon">💬</div>
                            <div class="empty-state-title">Belum ada topik diskusi</div>
                            <div class="empty-state-desc">Jadilah yang pertama memulai diskusi! Klik tombol "Buat Topik Baru" untuk memulai.</div>
                        </div>
                    @endforelse
                </div>

                <!-- Sidebar Right -->
                <div class="forum-sidebar">
                    <!-- Stats -->
                    <div class="forum-sidebar-card">
                        <h4>📊 Statistik Forum</h4>
                        <div class="stats-grid">
                            <div class="stat-box">
                                <div class="stat-box-value">{{ $forums->count() }}</div>
                                <div class="stat-box-label">Topik</div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-box-value">{{ $forums->sum('chats_count') }}</div>
                                <div class="stat-box-label">Pesan</div>
                            </div>
                        </div>
                    </div>

                    <!-- Trending Topics -->
                    <div class="forum-sidebar-card">
                        <h4>🔥 Topik Tren</h4>
                        <div>
                            <span class="trending-tag">#DesignSystem</span>
                            <span class="trending-tag">#AI</span>
                            <span class="trending-tag">#WebDev</span>
                            <span class="trending-tag">#Laravel</span>
                            <span class="trending-tag">#UIDesign</span>
                            <span class="trending-tag">#Backend</span>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="forum-sidebar-card" style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%); border: none; color: #fff;">
                        <h4 style="color: #fff;">👤 Profil Saya</h4>
                        <div style="font-size: 0.95rem; font-weight: 700;">{{ auth()->user()->name }}</div>
                        <div style="font-size: 0.78rem; color: rgba(255,255,255,0.8); margin-top: 0.25rem;">
                            {{ ucfirst(auth()->user()->role ?? 'student') }}
                            •
                            {{ strtoupper(auth()->user()->package ?? 'FREE') }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Create Forum Modal -->
    <div class="modal-overlay" id="createForumModal">
        <div class="modal-content">
            <h3 class="modal-title">Buat Topik Diskusi Baru</h3>
            <form method="POST" action="{{ route('forum.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="forum-title">Judul Topik *</label>
                    <input type="text" name="title" id="forum-title" class="form-input" placeholder="Contoh: Bagaimana cara membuat API REST?" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="forum-description">Deskripsi (opsional)</label>
                    <textarea name="description" id="forum-description" class="form-textarea" placeholder="Jelaskan topik diskusi yang ingin dibahas..."></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="document.getElementById('createForumModal').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-primary">Buat Topik</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Close modal when clicking overlay
        document.getElementById('createForumModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('createForumModal').classList.remove('active');
            }
        });
    </script>
</body>
</html>