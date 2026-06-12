<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Kelola Pertanyaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151; }
        .form-input, .form-textarea { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit; }
        .btn-primary { background: #7c3aed; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; }
        .question-card { background: #f9fafb; padding: 1.5rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #e5e7eb; }
        .option-item { margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
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
                <li class="sidebar-menu-item"><a href="{{ route('teacher.live-sessions.index') }}" class="sidebar-menu-link">Kelas Live</a></li>
                <li class="sidebar-menu-item"><a href="{{ route('teacher.feedbacks.index') }}" class="sidebar-menu-link">Feedback</a></li>
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
            <div class="content-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="greeting">{{ $quiz->title }}</div>
                    <div class="greeting-subtitle">{{ $quiz->description }}</div>
                </div>
                <a href="{{ route('teacher.quizzes.index') }}" class="btn-primary" style="background: #e5e7eb; color: #374151; text-decoration: none;">&larr; Kembali</a>
            </div>

            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Daftar Pertanyaan -->
            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">Daftar Pertanyaan</h3>
                @forelse($quiz->questions as $index => $question)
                    <div class="question-card">
                        <div style="font-weight: 600; margin-bottom: 0.5rem;">{{ $index + 1 }}. {{ $question->question_text }}</div>
                        <ul style="list-style: none; padding-left: 1rem; color: #4b5563;">
                            @foreach($question->options as $option)
                                <li style="{{ $option->is_correct ? 'color: #16a34a; font-weight: 600;' : '' }}">
                                    {{ $option->is_correct ? '✅' : '⚪' }} {{ $option->option_text }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <p style="color: #6b7280;">Belum ada pertanyaan. Silakan tambahkan di bawah.</p>
                @endforelse
            </div>

            <!-- Form Tambah Pertanyaan -->
            <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">Tambah Pertanyaan Baru</h3>
                <form action="{{ route('teacher.quizzes.questions.store', $quiz) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Pertanyaan</label>
                        <textarea name="question_text" class="form-textarea" rows="3" required placeholder="Tuliskan pertanyaan..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pilihan Jawaban (Pilih radio button untuk jawaban yang benar)</label>
                        @for($i = 0; $i < 4; $i++)
                            <div class="option-item">
                                <input type="radio" name="correct_option" value="{{ $i }}" {{ $i == 0 ? 'checked' : '' }}>
                                <input type="text" name="options[]" class="form-input" required placeholder="Opsi {{ $i + 1 }}">
                            </div>
                        @endfor
                    </div>

                    <button type="submit" class="btn-primary">+ Tambah Pertanyaan</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
