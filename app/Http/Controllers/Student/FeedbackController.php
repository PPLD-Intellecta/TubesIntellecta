<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with(['teacher', 'quiz'])
            ->where('student_id', auth()->id())
            ->latest()
            ->get();

        return view('student.feedbacks.index', compact('feedbacks'));
    }

    public function show(Feedback $feedback)
    {
        $this->authorizeStudent($feedback);

        if (! $feedback->is_read) {
            $feedback->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }

        $feedback->load(['teacher', 'quiz', 'quizAttempt.quiz']);

        return view('student.feedbacks.show', compact('feedback'));
    }

    private function authorizeStudent(Feedback $feedback): void
    {
        if ($feedback->student_id !== auth()->id()) {
            abort(403);
        }
    }
}
