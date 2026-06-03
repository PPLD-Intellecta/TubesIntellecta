<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Hasil Kuis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f9f8ff; color: #1a1a2e; min-height: 100vh; display: flex; flex-direction: column; }
        .navbar {
            background: white; border-bottom: 1px solid #e8e4ff;
            padding: 0 3rem; display: flex; align-items: center; justify-content: space-between; height: 64px;
        }
        .navbar-logo { font-size: 1.4rem; font-weight: 800; color: #5b21b6; text-decoration: none; }
        .navbar-links { display: flex; gap: 2rem; }
        .navbar-links a { text-decoration: none; color: #6b7280; font-size: 0.9rem; font-weight: 500; }
        .navbar-links a.active { color: #5b21b6; }

        .main { flex: 1; display: flex; align-items: center; justify-content: center; padding: 3rem 2rem; }
        .result-card {
            background: white;
            border-radius: 1.5rem;
            padding: 3.5rem;
            border: 1.5px solid #e8e4ff;
            text-align: center;
            max-width: 520px;
            width: 100%;
            box-shadow: 0 8px 40px rgba(91, 33, 182, 0.08);
        }
        .result-emoji { font-size: 3.5rem; margin-bottom: 1rem; }
        .result-title { font-size: 1.75rem; font-weight: 800; margin-bottom: 0.25rem; }
        .result-quiz-name { color: #6b7280; font-size: 0.9rem; margin-bottom: 2rem; }

        .score-ring-wrap { display: flex; justify-content: center; margin-bottom: 2rem; }
        .score-ring {
            width: 160px; height: 160px;
            border-radius: 50%;
            border: 10px solid #e8e4ff;
            display: flex; align-items: center; justify-content: center;
            flex-direction: column;
            position: relative;
        }
        .score-ring.excellent { border-color: #5b21b6; background: #faf5ff; }
        .score-ring.good { border-color: #0d9488; background: #f0fdfa; }
        .score-ring.average { border-color: #f59e0b; background: #fffbeb; }
        .score-ring.low { border-color: #ef4444; background: #fef2f2; }
        .score-number { font-size: 2.75rem; font-weight: 800; }
        .score-ring.excellent .score-number { color: #5b21b6; }
        .score-ring.good .score-number { color: #0d9488; }
        .score-ring.average .score-number { color: #f59e0b; }
        .score-ring.low .score-number { color: #ef4444; }
        .score-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: #9ca3af; font-weight: 600; }

        .result-message { font-size: 1rem; font-weight: 500; color: #374151; margin-bottom: 2rem; line-height: 1.6; }
        .result-actions { display: flex; flex-direction: column; gap: 0.75rem; }
        .btn-primary {
            background: #5b21b6; color: white; padding: 0.875rem 1.5rem;
            border-radius: 0.875rem; font-weight: 600; font-size: 0.9rem;
            text-decoration: none; display: block; text-align: center; transition: background 0.2s;
        }
        .btn-primary:hover { background: #4c1d95; }
        .btn-secondary {
            background: #f3f4f6; color: #374151; padding: 0.875rem 1.5rem;
            border-radius: 0.875rem; font-weight: 600; font-size: 0.9rem;
            text-decoration: none; display: block; text-align: center; transition: background 0.2s;
        }
        .btn-secondary:hover { background: #e5e7eb; }

        footer { text-align: center; padding: 1.5rem; font-size: 0.75rem; color: #9ca3af; border-top: 1px solid #e8e4ff; }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="navbar-logo">Intellecta</a>
        <div class="navbar-links">
            <a href="{{ route('student.quizzes.index') }}" class="active">My Courses</a>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('student.feedbacks.index') }}">Feedback</a>
        </div>
    </nav>

    <div class="main">
        @php
            $score = $attempt->score;
            if ($score >= 85) { $ring = 'excellent'; $emoji = '🏆'; $msg = 'Luar biasa! Kamu menguasai materi ini dengan sangat baik. Pertahankan prestasimu!'; }
            elseif ($score >= 70) { $ring = 'good'; $emoji = '🎉'; $msg = 'Kerja bagus! Pemahaman kamu sudah cukup solid. Terus tingkatkan!'; }
            elseif ($score >= 50) { $ring = 'average'; $emoji = '📖'; $msg = 'Lumayan! Kamu sudah di jalur yang benar. Coba pelajari kembali materi yang kurang.'; }
            else { $ring = 'low'; $emoji = '💪'; $msg = 'Jangan menyerah! Setiap ahli pernah menjadi pemula. Pelajari materinya lagi dan coba kembali.'; }
        @endphp

        <div class="result-card">
            <div class="result-emoji">{{ $emoji }}</div>
            <div class="result-title">Kuis Selesai!</div>
            <div class="result-quiz-name">{{ $attempt->quiz->title }}</div>

            <div class="score-ring-wrap">
                <div class="score-ring {{ $ring }}">
                    <div class="score-number">{{ $attempt->score }}</div>
                    <div class="score-label">Score</div>
                </div>
            </div>

            <div class="result-message">{{ $msg }}</div>

            <div class="result-actions">
                <a href="{{ route('student.quizzes.index') }}" class="btn-primary">← Kembali ke Daftar Kuis</a>
                <a href="{{ route('dashboard') }}" class="btn-secondary">Pergi ke Dashboard</a>
            </div>
        </div>
    </div>

    <footer>Intellecta © 2024 Intellecta Editorial Learning. All Rights Reserved.</footer>
</body>
</html>
