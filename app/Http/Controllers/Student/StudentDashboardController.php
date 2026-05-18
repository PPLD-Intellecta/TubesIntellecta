<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Carbon\Carbon;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Total quiz yang tersedia
        $totalQuizzes = Quiz::count();

        // Jumlah quiz berbeda yang sudah dikerjakan siswa
        $completedQuizzes = QuizAttempt::where('user_id', $userId)
            ->distinct('quiz_id')
            ->count('quiz_id');

        // Progress belajar berdasarkan quiz yang sudah dikerjakan
        $progressPercentage = $totalQuizzes > 0
            ? round(($completedQuizzes / $totalQuizzes) * 100)
            : 0;

        // Rata-rata nilai quiz siswa
        $averageScore = QuizAttempt::where('user_id', $userId)
            ->avg('score');

        $averageScore = $averageScore ? round($averageScore) : 0;

        // Riwayat aktivitas quiz terbaru
        $learningHistories = QuizAttempt::with('quiz')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // Progress belajar mingguan berdasarkan jumlah quiz yang dikerjakan per hari
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weeklyAttempts = QuizAttempt::where('user_id', $userId)
        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->selectRaw("DAYOFWEEK(created_at) as day_number, COUNT(*) as total")
        ->groupBy('day_number')
        ->pluck('total', 'day_number')
        ->toArray();

        // MySQL DAYOFWEEK(): 1=Sunday, 2=Monday, 3=Tuesday, ..., 7=Saturday
        $weeklyProgress = [
            ['label' => 'SEN', 'total' => $weeklyAttempts[2] ?? 0],
            ['label' => 'SEL', 'total' => $weeklyAttempts[3] ?? 0],
            ['label' => 'RAB', 'total' => $weeklyAttempts[4] ?? 0],
            ['label' => 'KAM', 'total' => $weeklyAttempts[5] ?? 0],
            ['label' => 'JUM', 'total' => $weeklyAttempts[6] ?? 0],
            ['label' => 'SAB', 'total' => $weeklyAttempts[7] ?? 0],
            ['label' => 'MIN', 'total' => $weeklyAttempts[1] ?? 0],
        ];

        $maxWeeklyActivity = collect($weeklyProgress)->max('total');
        $maxWeeklyActivity = $maxWeeklyActivity > 0 ? $maxWeeklyActivity : 1;

        $weeklyProgress = collect($weeklyProgress)->map(function ($day) use ($maxWeeklyActivity) {
            return [
                'label' => $day['label'],
                'total' => $day['total'],
                'height' => 45 + (($day['total'] / $maxWeeklyActivity) * 100),
                'is_active' => $day['total'] > 0,
            ];
        });

        // Streak belajar berdasarkan tanggal siswa mengerjakan quiz
        $activityDates = QuizAttempt::where('user_id', $userId)
            ->selectRaw('DATE(created_at) as activity_date')
            ->distinct()
            ->orderByDesc('activity_date')
            ->pluck('activity_date')
            ->map(function ($date) {
                return Carbon::parse($date)->format('Y-m-d');
            })
            ->toArray();

        $streakDays = 0;
        $today = Carbon::today();

        foreach ($activityDates as $date) {
            $expectedDate = $today->copy()->subDays($streakDays)->format('Y-m-d');

            if ($date === $expectedDate) {
                $streakDays++;
            } else {
                break;
            }
        }

        // Kalau hari ini belum ada aktivitas, streak tetap dihitung dari kemarin
        if ($streakDays === 0 && count($activityDates) > 0) {
            $yesterday = Carbon::yesterday();

            foreach ($activityDates as $date) {
                $expectedDate = $yesterday->copy()->subDays($streakDays)->format('Y-m-d');

                if ($date === $expectedDate) {
                    $streakDays++;
                } else {
                    break;
                }
            }
        }

        // Reward otomatis sederhana berdasarkan pencapaian siswa
        $rewards = [];

        if ($streakDays >= 7) {
            $rewards[] = [
                'icon' => '🏅',
                'title' => 'Streak 7 Hari',
                'description' => 'Didapat setelah belajar 7 hari berturut-turut.'
            ];
        }

        if ($progressPercentage >= 70) {
            $rewards[] = [
                'icon' => '🎯',
                'title' => 'Target Tercapai',
                'description' => 'Didapat setelah progress belajar mencapai 70%.'
            ];
        }

        if ($completedQuizzes > 0) {
            $rewards[] = [
                'icon' => '⭐',
                'title' => 'Quiz Selesai',
                'description' => 'Didapat setelah menyelesaikan minimal satu quiz.'
            ];
        }

        if ($averageScore >= 90) {
            $rewards[] = [
                'icon' => '🏆',
                'title' => 'Nilai Unggul',
                'description' => 'Didapat setelah rata-rata nilai quiz mencapai 90%.'
            ];
        }

        return view('student.dashboard', compact(
            'totalQuizzes',
            'completedQuizzes',
            'progressPercentage',
            'averageScore',
            'learningHistories',
            'weeklyProgress',
            'streakDays',
            'rewards'
        ));
    }
}