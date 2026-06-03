<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Kuis & Evaluasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f9f8ff; color: #1a1a2e; }

        /* Navbar */
        .navbar {
            background: white;
            border-bottom: 1px solid #e8e4ff;
            padding: 0 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-logo { font-size: 1.4rem; font-weight: 800; color: #5b21b6; text-decoration: none; }
        .navbar-links { display: flex; gap: 2rem; align-items: center; }
        .navbar-links a { text-decoration: none; color: #6b7280; font-size: 0.9rem; font-weight: 500; transition: color 0.2s; }
        .navbar-links a:hover, .navbar-links a.active { color: #5b21b6; border-bottom: 2px solid #5b21b6; padding-bottom: 2px; }
        .navbar-right { display: flex; align-items: center; gap: 1rem; }
        .btn-logout { background: none; border: 1px solid #e5e7eb; color: #6b7280; padding: 0.4rem 1rem; border-radius: 0.5rem; cursor: pointer; font-size: 0.875rem; font-family: inherit; transition: all 0.2s; }
        .btn-logout:hover { border-color: #ef4444; color: #ef4444; }

        /* Hero */
        .hero {
            background: white;
            border-bottom: 1px solid #e8e4ff;
            padding: 2.5rem 3rem;
        }
        .hero-inner { max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .hero-title { font-size: 2rem; font-weight: 800; color: #1a1a2e; margin-bottom: 0.5rem; }
        .hero-sub { color: #6b7280; font-size: 0.9rem; }

        /* Main */
        .main { max-width: 1100px; margin: 2.5rem auto; padding: 0 3rem; }

        /* Quiz Grid */
        .quiz-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        .quiz-card {
            background: white;
            border-radius: 1.25rem;
            overflow: hidden;
            border: 1.5px solid #e8e4ff;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
        }
        .quiz-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(91, 33, 182, 0.12);
            border-color: #c4b5fd;
        }
        .quiz-thumb {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }
        .quiz-thumb.purple { background: linear-gradient(135deg, #5b21b6, #7c3aed); }
        .quiz-thumb.teal { background: linear-gradient(135deg, #0d9488, #14b8a6); }
        .quiz-thumb.orange { background: linear-gradient(135deg, #ea580c, #f97316); }
        .quiz-thumb.blue { background: linear-gradient(135deg, #1d4ed8, #3b82f6); }
        .quiz-thumb.pink { background: linear-gradient(135deg, #be185d, #ec4899); }
        .quiz-thumb.green { background: linear-gradient(135deg, #15803d, #22c55e); }
        .quiz-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
        .quiz-tags { display: flex; gap: 0.5rem; margin-bottom: 0.75rem; }
        .quiz-tag { font-size: 0.7rem; font-weight: 600; padding: 0.25rem 0.6rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em; }
        .quiz-tag.module { background: #ede9fe; color: #5b21b6; }
        .quiz-tag.count { background: #f3f4f6; color: #6b7280; }
        .quiz-title { font-size: 1rem; font-weight: 700; margin-bottom: 0.5rem; color: #1a1a2e; line-height: 1.4; }
        .quiz-desc { font-size: 0.8rem; color: #9ca3af; line-height: 1.6; flex: 1; margin-bottom: 1.25rem; }
        .quiz-teacher { display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; color: #6b7280; margin-bottom: 1.25rem; }
        .teacher-avatar { width: 28px; height: 28px; border-radius: 9999px; background: linear-gradient(135deg, #5b21b6, #a78bfa); display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: white; font-weight: 700; flex-shrink: 0; }
        .btn-start {
            display: block;
            background: #5b21b6;
            color: white;
            padding: 0.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.875rem;
            text-align: center;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-start:hover { background: #4c1d95; }

        /* Empty state */
        .empty-state { text-align: center; padding: 5rem 2rem; color: #9ca3af; }
        .empty-state .emoji { font-size: 4rem; margin-bottom: 1rem; }
        .empty-state h3 { font-size: 1.25rem; font-weight: 600; color: #6b7280; margin-bottom: 0.5rem; }

        /* Footer */
        footer { background: white; border-top: 1px solid #e8e4ff; padding: 1.5rem 3rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; color: #9ca3af; margin-top: 4rem; }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { color: #9ca3af; text-decoration: none; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="navbar-logo">Intellecta</a>
        <div class="navbar-links">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('student.quizzes.index') }}" class="active">My Courses</a>
            <a href="{{ route('subscription.index') }}">Resources</a>
            <a href="{{ route('student.planner.index') }}">Study Planner</a>
        </div>
        <div class="navbar-right">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Keluar</button>
            </form>
        </div>
    </nav>

    <!-- Hero -->
    <div class="hero">
        <div class="hero-inner">
            <div>
                <h1 class="hero-title">Kuis & Evaluasi 📝</h1>
                <p class="hero-sub">Uji pemahaman kamu. Pilih kuis dan mulai evaluasi sekarang.</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        @forelse($quizzes as $index => $quiz)
            @if($loop->first)
                <div class="quiz-grid">
            @endif

            @php
                $colors = ['purple', 'teal', 'orange', 'blue', 'pink', 'green'];
                $emojis = ['📖', '🧪', '🔬', '💡', '🎯', '🏆'];
                $color = $colors[$index % count($colors)];
                $emoji = $emojis[$index % count($emojis)];
                $questionCount = $quiz->questions->count();
            @endphp

            <div class="quiz-card">
                <div class="quiz-thumb {{ $color }}">{{ $emoji }}</div>
                <div class="quiz-body">
                    <div class="quiz-tags">
                        <span class="quiz-tag module">KUIS</span>
                        <span class="quiz-tag count">{{ $questionCount }} Soal</span>
                    </div>
                    <div class="quiz-title">{{ $quiz->title }}</div>
                    <div class="quiz-desc">{{ $quiz->description ?? 'Kerjakan kuis ini untuk menguji pemahamanmu.' }}</div>
                    <div class="quiz-teacher">
                        <div class="teacher-avatar">{{ strtoupper(substr($quiz->teacher->name ?? 'T', 0, 1)) }}</div>
                        <span>{{ $quiz->teacher->name ?? 'Pengajar' }}</span>
                    </div>
                    <a href="{{ route('student.quizzes.show', $quiz) }}" class="btn-start">Mulai Kerjakan →</a>
                </div>
            </div>

            @if($loop->last)
                </div>
            @endif
        @empty
            <div class="empty-state">
                <div class="emoji">📭</div>
                <h3>Belum ada kuis tersedia</h3>
                <p>Tunggu pengajar membuat kuis baru untuk kamu kerjakan.</p>
            </div>
        @endforelse
    </div>

    <!-- Footer -->
    <footer>
        <div>Intellecta © 2024 Intellecta Indonesia. Cerdas & Fokus.</div>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Accessibility</a>
            <a href="#">Contact Support</a>
        </div>
    </footer>
</body>
</html>
