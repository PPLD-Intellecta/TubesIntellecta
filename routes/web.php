<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ForumController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\PaketBerlanggananController;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('videos', \App\Http\Controllers\Admin\VideoController::class)->except(['show']);

    // Admin Forum Moderation (FR-17)
    Route::get('/forum', [AdminForumController::class, 'index'])->name('forum.index');
    Route::delete('/forum/chat/{chat}', [AdminForumController::class, 'destroyChat'])->name('forum.chat.destroy');
    Route::delete('/forum/{forum}', [AdminForumController::class, 'destroyForum'])->name('forum.destroy');
});
Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware(['auth']);

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


