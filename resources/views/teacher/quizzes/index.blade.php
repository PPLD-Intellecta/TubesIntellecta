<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Teacher Quizzes</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .btn-primary { background: #7c3aed; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; }
        .quiz-card { background: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 1rem; }
        .quiz-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">Intellecta</div>
            <div class="sidebar-subtitle">Teacher Panel</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item"><a href="{{ route('teacher.quizzes.index') }}" class="sidebar-menu-link active">Kelola Kuis</a></li>
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
            <div class="content-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div class="greeting">Kelola Kuis</div>
                    <div class="greeting-subtitle">Buat dan kelola kuis untuk siswa Anda.</div>
                </div>
                <a href="{{ route('teacher.quizzes.create') }}" class="btn-primary">+ Buat Kuis Baru</a>
            </div>

            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="courses-grid" style="grid-template-columns: 1fr;">
                @forelse($quizzes as $quiz)
                    <div class="quiz-card">
                        <div class="quiz-title">{{ $quiz->title }}</div>
                        <p style="color: #6b7280; margin-bottom: 1rem;">{{ $quiz->description }}</p>
                        <a href="{{ route('teacher.quizzes.show', $quiz) }}" class="btn-primary" style="background: #e5e7eb; color: #374151;">Kelola Pertanyaan</a>
                    </div>
                @empty
                    <p style="color: #6b7280;">Belum ada kuis yang dibuat.</p>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>
