<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizAttempt;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('teacher')->get();
        return view('student.quizzes.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $quiz->load(['questions.options']);
        return view('student.quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'exists:options,id',
        ]);

        $score = 0;
        $totalQuestions = $quiz->questions()->count();

        if ($totalQuestions > 0) {
            $correctAnswers = 0;
            foreach ($quiz->questions as $question) {
                if (isset($request->answers[$question->id])) {
                    $selectedOptionId = $request->answers[$question->id];
                    $option = $question->options()->find($selectedOptionId);
                    if ($option && $option->is_correct) {
                        $correctAnswers++;
                    }
                }
            }
            $score = ($correctAnswers / $totalQuestions) * 100;
        }

        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'user_id' => auth()->id(),
            'score' => round($score),
        ]);

        return redirect()->route('student.quizzes.result', $attempt);
    }

    public function result(QuizAttempt $attempt)
    {
        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        return view('student.quizzes.result', compact('attempt'));
    }
}
