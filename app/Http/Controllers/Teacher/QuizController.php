<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('teacher_id', auth()->id())->get();
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
        if ($quiz->teacher_id !== auth()->id()) {
            abort(403);
        }
        $quiz->load('questions.options');
        return view('teacher.quizzes.show', compact('quiz'));
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        if ($quiz->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'question_text' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_option' => 'required|integer|min:0',
        ]);

        $question = $quiz->questions()->create([
            'question_text' => $request->question_text,
        ]);

        foreach ($request->options as $index => $optionText) {
            $question->options()->create([
                'option_text' => $optionText,
                'is_correct' => (int) $request->correct_option === $index,
            ]);
        }

        return redirect()->route('teacher.quizzes.show', $quiz)->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function destroy(Quiz $quiz)
    {
        if ($quiz->teacher_id !== auth()->id()) {
            abort(403);
        }

        $quiz->delete();

        return redirect()->route('teacher.quizzes.index')->with('success', 'Kuis berhasil dihapus.');
    }
}
