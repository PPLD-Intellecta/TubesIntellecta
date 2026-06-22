<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Edit Soal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151; }
        .form-input, .form-textarea, .form-select { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit; }
        .btn-primary-custom { background: #7c3aed; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; }
        .option-item { margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('teacher.partials.sidebar', ['active' => 'quizzes'])

        <main class="main-content">
            <div class="content-header mb-4">
                <div class="greeting">Edit Soal</div>
                <div class="greeting-subtitle">{{ $quiz->title }}</div>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <form action="{{ route('teacher.quizzes.questions.update', [$quiz, $question]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Pertanyaan</label>
                        <textarea name="question_text" class="form-textarea" rows="3" required>{{ old('question_text', $question->question_text) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tingkat Kesulitan</label>
                        <select name="tingkat_kesulitan" class="form-select" required>
                            @foreach(\App\Models\Question::TINGKAT_KESULITAN as $level)
                                <option value="{{ $level }}" @selected(old('tingkat_kesulitan', $question->tingkat_kesulitan ?? 'Sedang') === $level)>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pilihan Jawaban</label>
                        @php
                            $correctIndex = $question->options->search(fn ($opt) => $opt->is_correct);
                            $correctIndex = $correctIndex === false ? 0 : $correctIndex;
                        @endphp
                        @foreach(['A', 'B', 'C', 'D'] as $i => $label)
                            <div class="option-item">
                                <input type="radio" name="correct_option" value="{{ $i }}" {{ (int) old('correct_option', $correctIndex) === $i ? 'checked' : '' }}>
                                <input type="text" name="options[]" class="form-input" required placeholder="Opsi {{ $label }}" value="{{ old('options.'.$i, $question->options[$i]->option_text ?? '') }}">
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-primary-custom">Simpan Perubahan</button>
                        <a href="{{ route('teacher.quizzes.show', $quiz) }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
