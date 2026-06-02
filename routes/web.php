<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ForumController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\PaketBerlanggananController;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('videos', \App\Http\Controllers\Admin\VideoController::class)->except(['show']);
});
Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware(['auth']);
Route::get('/forum', [ForumController::class, 'index'])->middleware('auth');
Route::get('/', function () {
    return redirect('/register');
Route::resource('paket-berlangganan', PaketBerlanggananController::class);
});

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
    Route::get('/forum', function () {
        return view('student.forum');
    })->name('forum');

    // Student Quiz routes
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/quizzes', [\App\Http\Controllers\Student\QuizController::class, 'index'])->name('quizzes.index');
        Route::get('/quizzes/{quiz}', [\App\Http\Controllers\Student\QuizController::class, 'show'])->name('quizzes.show');
        Route::post('/quizzes/{quiz}/submit', [\App\Http\Controllers\Student\QuizController::class, 'submit'])->name('quizzes.submit');
        Route::get('/quizzes/result/{attempt}', [\App\Http\Controllers\Student\QuizController::class, 'result'])->name('quizzes.result');
        
        // Student Video routes
        Route::get('/videos', [\App\Http\Controllers\Student\VideoController::class, 'index'])->name('videos.index');
        Route::get('/videos/{video}', [\App\Http\Controllers\Student\VideoController::class, 'show'])->name('videos.show');
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
});



