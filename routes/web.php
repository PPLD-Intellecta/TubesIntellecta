<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ForumController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\PaketBerlanggananController;
use App\Http\Controllers\Student\StudyPlannerController;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('videos', \App\Http\Controllers\Admin\VideoController::class)->except(['show']);

    // Admin Forum Moderation (FR-17)
    Route::get('/forum', [AdminForumController::class, 'index'])->name('forum.index');
    Route::delete('/forum/chat/{chat}', [AdminForumController::class, 'destroyChat'])->name('forum.chat.destroy');
    Route::delete('/forum/{forum}', [AdminForumController::class, 'destroyForum'])->name('forum.destroy');

    // Admin News routes
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
});
Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware(['auth', 'role:student'])
    ->name('student.dashboard');

Route::get('/', function () {
    return redirect('/register');
});

Route::resource('paket-berlangganan', PaketBerlanggananController::class);

Route::get('/dashboard', function () {

    if (auth()->user()->role == 'admin') {
        return redirect('/admin/dashboard');
    }

    if (auth()->user()->role == 'teacher') {
        return redirect('/teacher/quizzes');
    }

    return redirect('/student/dashboard');

})->middleware(['auth'])->name('dashboard'); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    // Forum routes (FR-09 - accessible by all users)
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{forum}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{forum}/chat', [ForumController::class, 'storeChat'])->name('forum.chat.store');

    // Student Quiz routes
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/quizzes', [\App\Http\Controllers\Student\QuizController::class, 'index'])->name('quizzes.index');
        Route::get('/quizzes/{quiz}', [\App\Http\Controllers\Student\QuizController::class, 'show'])->name('quizzes.show');
        Route::post('/quizzes/{quiz}/submit', [\App\Http\Controllers\Student\QuizController::class, 'submit'])->name('quizzes.submit');
        Route::get('/quizzes/result/{attempt}', [\App\Http\Controllers\Student\QuizController::class, 'result'])->name('quizzes.result');
        
        // Student Video routes
        Route::get('/videos', [\App\Http\Controllers\Student\VideoController::class, 'index'])
            ->name('videos.index');

        Route::get('/videos/{video}', [\App\Http\Controllers\Student\VideoController::class, 'show'])
            ->name('videos.show');

        Route::post('/videos/{video}/complete', [\App\Http\Controllers\Student\VideoController::class, 'complete'])
            ->name('videos.complete');

        // Student Feedback routes
        Route::get('/feedbacks', [\App\Http\Controllers\Student\FeedbackController::class, 'index'])->name('feedbacks.index');
        Route::get('/feedbacks/{feedback}', [\App\Http\Controllers\Student\FeedbackController::class, 'show'])->name('feedbacks.show');

        // Student News routes
        Route::get('/news', [\App\Http\Controllers\Student\NewsController::class, 'index'])->name('news.index');
        Route::get('/news/{news}', [\App\Http\Controllers\Student\NewsController::class, 'show'])->name('news.show');
    });

    // Subscription routes
    Route::get('/subscription', [\App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('/subscription/checkout', [\App\Http\Controllers\SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    Route::post('/subscription/upgrade', [\App\Http\Controllers\SubscriptionController::class, 'upgrade'])->name('subscription.upgrade');

    // Teacher routes
    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/quizzes', [\App\Http\Controllers\Teacher\QuizController::class, 'index'])->name('quizzes.index');
        Route::get('/quizzes/create', [\App\Http\Controllers\Teacher\QuizController::class, 'create'])->name('quizzes.create');
        Route::post('/quizzes', [\App\Http\Controllers\Teacher\QuizController::class, 'store'])->name('quizzes.store');
        Route::get('/quizzes/{quiz}', [\App\Http\Controllers\Teacher\QuizController::class, 'show'])->name('quizzes.show');
        Route::post('/quizzes/{quiz}/questions', [\App\Http\Controllers\Teacher\QuizController::class, 'storeQuestion'])->name('quizzes.questions.store');

        Route::get('/materi', [\App\Http\Controllers\Teacher\MateriController::class, 'index'])->name('materi.index');
        Route::get('/materi/create', [\App\Http\Controllers\Teacher\MateriController::class, 'create'])->name('materi.create');
        Route::post('/materi', [\App\Http\Controllers\Teacher\MateriController::class, 'store'])->name('materi.store');

        Route::resource('feedbacks', \App\Http\Controllers\Teacher\FeedbackController::class);
    });
});

// Live Teaching Class Schedule Routes
Route::prefix('teacher')->middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/live-sessions', [\App\Http\Controllers\Teacher\TeacherSessionController::class, 'index'])->name('teacher.live-sessions.index');
    Route::get('/live-sessions/create', [\App\Http\Controllers\Teacher\TeacherSessionController::class, 'create'])->name('teacher.live-sessions.create');
    Route::post('/live-sessions', [\App\Http\Controllers\Teacher\TeacherSessionController::class, 'store'])->name('teacher.live-sessions.store');
    Route::get('/live-sessions/{session}/edit', [\App\Http\Controllers\Teacher\TeacherSessionController::class, 'edit'])->name('teacher.live-sessions.edit');
    Route::put('/live-sessions/{session}', [\App\Http\Controllers\Teacher\TeacherSessionController::class, 'update'])->name('teacher.live-sessions.update');
    Route::delete('/live-sessions/{session}', [\App\Http\Controllers\Teacher\TeacherSessionController::class, 'destroy'])->name('teacher.live-sessions.destroy');
});

Route::prefix('student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/live-schedule', [\App\Http\Controllers\Student\StudentSessionController::class, 'index'])->name('student.live-schedule.index');
    Route::get('/live-sessions/{session}', [\App\Http\Controllers\Student\StudentSessionController::class, 'show'])->name('student.live-sessions.show');
    Route::post('/live-sessions/{session}/join', [\App\Http\Controllers\Student\StudentSessionController::class, 'join'])->name('student.live-sessions.join');

    // Study Planner routes
    Route::get('/study-planner', [StudyPlannerController::class, 'index'])->name('student.planner.index');
    Route::post('/study-planner/goals', [StudyPlannerController::class, 'storeGoal'])->name('student.planner.goals.store');
    Route::put('/study-planner/goals/{goal}', [StudyPlannerController::class, 'updateGoal'])->name('student.planner.goals.update');
    Route::delete('/study-planner/goals/{goal}', [StudyPlannerController::class, 'destroyGoal'])->name('student.planner.goals.destroy');
    Route::post('/study-planner/goals/{goal}/toggle', [StudyPlannerController::class, 'toggleGoal'])->name('student.planner.goals.toggle');
    Route::post('/study-planner/checkins', [StudyPlannerController::class, 'storeCheckin'])->name('student.planner.checkins.store');
    Route::get('/study-planner/calendar-data', [StudyPlannerController::class, 'calendarData'])->name('student.planner.calendar.data');
});



// Akhir dari file web routes
