<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - {{ $forum->title }}</title>
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
            <!-- Back Button -->
            <a href="{{ route('forum.index') }}" class="btn-back">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
                Kembali ke Forum
            </a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Chat Container -->
            <div class="chat-container">
                <!-- Chat Header -->
                <div class="chat-header">
                    <h2 class="chat-header-title">{{ $forum->title }}</h2>
                    @if($forum->description)
                        <p class="chat-header-desc">{{ $forum->description }}</p>
                    @endif
                    <div class="chat-header-meta">
                        <span>Dibuat oleh <strong>{{ $forum->user->name ?? 'Unknown' }}</strong></span>
                        <span>•</span>
                        <span>{{ $forum->created_at->diffForHumans() }}</span>
                        <span>•</span>
                        <span>{{ $forum->chats->count() }} pesan</span>
                    </div>
                </div>

                <!-- Chat Messages -->
                <div class="chat-messages" id="chatMessages">
                    @forelse($forum->chats as $chat)
                        <div class="chat-bubble {{ $chat->user_id === auth()->id() ? 'mine' : 'others' }}">
                            <div class="chat-bubble-sender">
                                {{ $chat->user->name ?? 'Unknown' }}
                                @if($chat->user->role === 'teacher')
                                    <span style="background: #dbeafe; color: #1d4ed8; padding: 0.15rem 0.4rem; border-radius: 999px; font-size: 0.62rem; font-weight: 700; margin-left: 0.25rem;">Pengajar</span>
                                @elseif($chat->user->role === 'admin')
                                    <span style="background: #fef3c7; color: #92400e; padding: 0.15rem 0.4rem; border-radius: 999px; font-size: 0.62rem; font-weight: 700; margin-left: 0.25rem;">Admin</span>
                                @endif
                            </div>
                            <div class="chat-bubble-content">
                                {{ $chat->message }}
                            </div>
                            <div class="chat-bubble-time">
                                {{ $chat->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-state-icon">🗨️</div>
                            <div class="empty-state-title">Belum ada pesan</div>
                            <div class="empty-state-desc">Jadilah yang pertama mengirim pesan di topik diskusi ini!</div>
                        </div>
                    @endforelse
                </div>

                <!-- Chat Input -->
                <div class="chat-input-area">
                    <form method="POST" action="{{ route('forum.chat.store', $forum) }}" class="chat-input-form">
                        @csrf
                        <textarea
                            name="message"
                            class="chat-input"
                            placeholder="Tulis pesan..."
                            required
                            rows="1"
                            id="chatInput"
                        ></textarea>
                        <button type="submit" class="chat-send-btn" title="Kirim Pesan">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Auto-scroll to bottom of chat
        const chatMessages = document.getElementById('chatMessages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Auto-resize textarea
        const chatInput = document.getElementById('chatInput');
        if (chatInput) {
            chatInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            });

            // Submit on Enter (Shift+Enter for new line)
            chatInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    this.closest('form').submit();
                }
            });
        }
    </script>
</body>
</html>
