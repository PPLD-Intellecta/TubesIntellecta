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
        .question-card { background: #f9fafb; padding: 1.5rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #e5e7eb; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .question-card:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .option-item { margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
        .btn-action-edit { background: #eff6ff; color: #3b82f6; text-decoration: none; font-size: 0.875rem; padding: 0.375rem 0.875rem; border-radius: 9999px; font-weight: 500; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.375rem; border: 1px solid transparent; }
        .btn-action-edit:hover { background: #dbeafe; border-color: #bfdbfe; color: #2563eb; }
        .btn-action-delete { background: #fef2f2; color: #ef4444; font-size: 0.875rem; padding: 0.375rem 0.875rem; border-radius: 9999px; font-weight: 500; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.375rem; border: 1px solid transparent; }
        .btn-action-delete:hover { background: #fee2e2; border-color: #fecaca; color: #dc2626; }
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
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                            <div style="font-weight: 600;">{{ $index + 1 }}. {{ $question->question_text }}</div>
                            <div style="display: flex; gap: 0.5rem; align-items: center;">
                                <a href="{{ route('teacher.quizzes.questions.edit', [$quiz, $question]) }}" class="btn-action-edit">
                                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>
                                <form action="{{ route('teacher.quizzes.questions.destroy', [$quiz, $question]) }}" method="POST" onsubmit="return confirm('Hapus pertanyaan ini?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-delete">
                                        <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
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
