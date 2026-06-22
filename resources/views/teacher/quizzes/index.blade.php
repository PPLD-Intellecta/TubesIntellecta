<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Kelola Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .btn-primary-custom { background: #7c3aed; border-color: #7c3aed; color: #fff; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.875rem; display: inline-block; }
        .btn-primary-custom:hover { background: #6d28d9; border-color: #6d28d9; color: #fff; }
        .quiz-card { background: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 1rem; }
        .quiz-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; }
        .badge-count { background: #ede9fe; color: #5b21b6; padding: 0.25rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('teacher.partials.sidebar', ['active' => 'quizzes'])

        <main class="main-content">
            <div class="content-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <div class="greeting">Kelola Quiz</div>
                    <div class="greeting-subtitle">Buat dan kelola kuis untuk siswa Anda.</div>
                </div>
                <a href="{{ route('teacher.quizzes.create') }}" class="btn-primary-custom">+ Buat Kuis Baru</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="courses-grid" style="grid-template-columns: 1fr;">
                @forelse($quizzes as $quiz)
                    <div class="quiz-card">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                            <div class="quiz-title">{{ $quiz->title }}</div>
                            <span class="badge-count">{{ $quiz->questions_count }} soal</span>
                        </div>
                        <p style="color: #6b7280; margin-bottom: 1rem;">{{ $quiz->description ?: 'Tidak ada deskripsi.' }}</p>
                        <a href="{{ route('teacher.quizzes.show', $quiz) }}" class="btn btn-sm btn-outline-primary">Kelola Soal</a>
                    </div>
                @empty
                    <p style="color: #6b7280;">Belum ada kuis yang dibuat.</p>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>
