<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Edit Pertanyaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151; }
        .form-input, .form-textarea { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit; }
        .btn-primary { background: #7c3aed; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; }
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
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="greeting">Edit Pertanyaan</div>
                    <div class="greeting-subtitle">Kuis: {{ $quiz->title }}</div>
                </div>
                <a href="{{ route('teacher.quizzes.show', $quiz) }}" class="btn-primary" style="background: #e5e7eb; color: #374151; text-decoration: none;">&larr; Batal</a>
            </div>

            <!-- Form Edit Pertanyaan -->
            <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <form action="{{ route('teacher.quizzes.questions.update', [$quiz, $question]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Pertanyaan</label>
                        <textarea name="question_text" class="form-textarea" rows="3" required placeholder="Tuliskan pertanyaan...">{{ old('question_text', $question->question_text) }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pilihan Jawaban (Pilih radio button untuk jawaban yang benar)</label>
                        @php
                            $optionsCount = max(4, $question->options->count());
                        @endphp
                        @for($i = 0; $i < $optionsCount; $i++)
                            @php
                                $option = $question->options[$i] ?? null;
                            @endphp
                            <div class="option-item">
                                <input type="radio" name="correct_option" value="{{ $i }}" {{ ($option && $option->is_correct) ? 'checked' : ($i == 0 && !$question->options->where('is_correct', true)->count() ? 'checked' : '') }}>
                                <input type="text" name="options[]" class="form-input" required placeholder="Opsi {{ $i + 1 }}" value="{{ old('options.'.$i, $option ? $option->option_text : '') }}">
                            </div>
                        @endfor
                    </div>

                    <button type="submit" class="btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
