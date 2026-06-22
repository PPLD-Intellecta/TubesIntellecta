<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Kelola Soal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151; }
        .form-input, .form-textarea, .form-select { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit; }
        .btn-primary-custom { background: #7c3aed; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; }
        .question-card { background: #f9fafb; padding: 1.5rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #e5e7eb; }
        .option-item { margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
        .badge-difficulty { font-size: 0.75rem; padding: 0.2rem 0.55rem; border-radius: 999px; font-weight: 600; }
        .badge-mudah { background: #dcfce7; color: #166534; }
        .badge-sedang { background: #fef3c7; color: #92400e; }
        .badge-sulit { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('teacher.partials.sidebar', ['active' => 'quizzes'])

        <main class="main-content">
            <div class="content-header mb-4">
                <div class="greeting">{{ $quiz->title }}</div>
                <div class="greeting-subtitle">{{ $quiz->description }}</div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="mb-4">
                <a href="{{ route('teacher.quizzes.index') }}" class="text-decoration-none text-muted">&larr; Kembali ke daftar quiz</a>
            </div>

            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">Daftar Soal</h3>
                @forelse($quiz->questions as $index => $question)
                    @php
                        $difficultyClass = match($question->tingkat_kesulitan) {
                            'Mudah' => 'badge-mudah',
                            'Sulit' => 'badge-sulit',
                            default => 'badge-sedang',
                        };
                    @endphp
                    <div class="question-card">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                            <div style="font-weight: 600;">{{ $index + 1 }}. {{ $question->question_text }}</div>
                            <span class="badge-difficulty {{ $difficultyClass }}">{{ $question->tingkat_kesulitan ?? 'Sedang' }}</span>
                        </div>
                        <ul style="list-style: none; padding-left: 1rem; color: #4b5563; margin-bottom: 1rem;">
                            @foreach($question->options as $optIndex => $option)
                                <li style="{{ $option->is_correct ? 'color: #16a34a; font-weight: 600;' : '' }}">
                                    {{ chr(65 + $optIndex) }}. {{ $option->option_text }}
                                    @if($option->is_correct) (Benar) @endif
                                </li>
                            @endforeach
                        </ul>
                        <div class="d-flex gap-2">
                            <a href="{{ route('teacher.quizzes.questions.edit', [$quiz, $question]) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('teacher.quizzes.questions.destroy', [$quiz, $question]) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="color: #6b7280;">Belum ada soal. Silakan tambahkan di bawah.</p>
                @endforelse
            </div>

            <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">Tambah Soal Baru</h3>
                <form action="{{ route('teacher.quizzes.questions.store', $quiz) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Pertanyaan</label>
                        <textarea name="question_text" class="form-textarea" rows="3" required placeholder="Tuliskan pertanyaan...">{{ old('question_text') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tingkat Kesulitan</label>
                        <select name="tingkat_kesulitan" class="form-select" required>
                            @foreach(\App\Models\Question::TINGKAT_KESULITAN as $level)
                                <option value="{{ $level }}" @selected(old('tingkat_kesulitan', 'Sedang') === $level)>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pilihan Jawaban (pilih radio untuk kunci jawaban)</label>
                        @foreach(['A', 'B', 'C', 'D'] as $i => $label)
                            <div class="option-item">
                                <input type="radio" name="correct_option" value="{{ $i }}" {{ (int) old('correct_option', 0) === $i ? 'checked' : '' }}>
                                <input type="text" name="options[]" class="form-input" required placeholder="Opsi {{ $label }}" value="{{ old('options.'.$i) }}">
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn-primary-custom">+ Tambah Soal</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
