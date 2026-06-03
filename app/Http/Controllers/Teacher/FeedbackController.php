<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with(['student', 'quiz'])
            ->where('teacher_id', auth()->id())
            ->latest()
            ->get();

        return view('teacher.feedbacks.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('teacher.feedbacks.create', $this->formData());
    }

    public function store(Request $request)
    {
        $validated = $this->validateFeedback($request);

        Feedback::create([
            ...$validated,
            'teacher_id' => auth()->id(),
            'is_read' => false,
        ]);

        return redirect()
            ->route('teacher.feedbacks.index')
            ->with('success', 'Feedback berhasil dikirim ke siswa.');
    }

    public function show(Feedback $feedback)
    {
        $this->authorizeTeacher($feedback);
        $feedback->load(['student', 'quiz', 'quizAttempt.quiz']);

        return view('teacher.feedbacks.show', compact('feedback'));
    }

    public function edit(Feedback $feedback)
    {
        $this->authorizeTeacher($feedback);

        return view('teacher.feedbacks.edit', array_merge(
            ['feedback' => $feedback],
            $this->formData()
        ));
    }

    public function update(Request $request, Feedback $feedback)
    {
        $this->authorizeTeacher($feedback);

        $validated = $this->validateFeedback($request);

        $feedback->update($validated);

        return redirect()
            ->route('teacher.feedbacks.show', $feedback)
            ->with('success', 'Feedback berhasil diperbarui.');
    }

    public function destroy(Feedback $feedback)
    {
        $this->authorizeTeacher($feedback);

        $feedback->delete();

        return redirect()
            ->route('teacher.feedbacks.index')
            ->with('success', 'Feedback berhasil dihapus.');
    }

    private function authorizeTeacher(Feedback $feedback): void
    {
        if ($feedback->teacher_id !== auth()->id()) {
            abort(403);
        }
    }

    private function formData(): array
    {
        $students = User::where('role', 'student')->orderBy('name')->get();
        $quizzes = Quiz::where('teacher_id', auth()->id())->orderBy('title')->get();

        return compact('students', 'quizzes');
    }

    private function validateFeedback(Request $request): array
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                Rule::exists('users', 'id')->where('role', 'student'),
            ],
            'quiz_id' => ['nullable', 'exists:quizzes,id'],
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'score' => 'nullable|numeric|min:0|max:100',
        ]);

        if (! empty($validated['quiz_id'])) {
            $quiz = Quiz::find($validated['quiz_id']);
            if (! $quiz || $quiz->teacher_id !== auth()->id()) {
                abort(403, 'Anda tidak dapat mengaitkan feedback dengan kuis ini.');
            }
        }

        // Form teacher tidak lagi menerima input percobaan kuis.
        // Nilainya dipaksa null agar konsisten.
        $validated['quiz_attempt_id'] = null;

        return $validated;
    }
}
