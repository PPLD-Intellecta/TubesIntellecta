<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ForumController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth']);
Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware(['auth']);
Route::get('/forum', [ForumController::class, 'index'])->middleware('auth');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    if (auth()->user()->role == 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/student/dashboard');
    }

})->middleware(['auth']);   

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/forum', function () {
    return view('student.forum');
})->middleware('auth');


