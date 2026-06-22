<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('teacher_id', auth()->id())
            ->withCount('questions')
            ->latest()
            ->get();

        return view('teacher.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('teacher.quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => auth()->id(),
        ]);

        return redirect()->route('teacher.quizzes.index')->with('success', 'Kuis berhasil dibuat.');
    }

    public function show(Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);
        $quiz->load('questions.options');

        return view('teacher.quizzes.show', compact('quiz'));
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $this->authorizeQuiz($quiz);

        $validated = $this->validateQuestion($request);

        $question = $quiz->questions()->create([
            'question_text' => $validated['question_text'],
            'tingkat_kesulitan' => $validated['tingkat_kesulitan'],
        ]);

        $this->syncOptions($question, $validated['options'], (int) $validated['correct_option']);

        return redirect()->route('teacher.quizzes.show', $quiz)->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function editQuestion(Quiz $quiz, Question $question)
    {
        $this->authorizeQuiz($quiz);
        $this->authorizeQuestion($quiz, $question);

        $question->load('options');

        return view('teacher.quizzes.edit-question', compact('quiz', 'question'));
    }

    public function updateQuestion(Request $request, Quiz $quiz, Question $question)
    {
        $this->authorizeQuiz($quiz);
        $this->authorizeQuestion($quiz, $question);

        $validated = $this->validateQuestion($request);

        $question->update([
            'question_text' => $validated['question_text'],
            'tingkat_kesulitan' => $validated['tingkat_kesulitan'],
        ]);

        $question->options()->delete();
        $this->syncOptions($question, $validated['options'], (int) $validated['correct_option']);

        return redirect()->route('teacher.quizzes.show', $quiz)->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroyQuestion(Quiz $quiz, Question $question)
    {
        $this->authorizeQuiz($quiz);
        $this->authorizeQuestion($quiz, $question);

        $question->delete();

        return redirect()->route('teacher.quizzes.show', $quiz)->with('success', 'Pertanyaan berhasil dihapus.');
    }

    private function authorizeQuiz(Quiz $quiz): void
    {
        if ($quiz->teacher_id !== auth()->id()) {
            abort(403);
        }
    }

    private function authorizeQuestion(Quiz $quiz, Question $question): void
    {
        if ($question->quiz_id !== $quiz->id) {
            abort(404);
        }
    }

    private function validateQuestion(Request $request): array
    {
        return $request->validate([
            'question_text' => 'required|string',
            'tingkat_kesulitan' => 'required|in:Mudah,Sedang,Sulit',
            'options' => 'required|array|size:4',
            'options.*' => 'required|string|max:500',
            'correct_option' => 'required|integer|min:0|max:3',
        ]);
    }

    private function syncOptions(Question $question, array $options, int $correctIndex): void
    {
        foreach ($options as $index => $optionText) {
            $question->options()->create([
                'option_text' => $optionText,
                'is_correct' => $correctIndex === $index,
            ]);
        }
    }
}
