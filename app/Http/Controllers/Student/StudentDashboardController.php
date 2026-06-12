<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Video;
use App\Models\VideoProgress;
use Carbon\Carbon;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalQuizzes = Quiz::count();

        $completedQuizzes = QuizAttempt::where('user_id', $userId)
            ->distinct('quiz_id')
            ->count('quiz_id');

        $progressPercentage = $totalQuizzes > 0
            ? round(($completedQuizzes / $totalQuizzes) * 100)
            : 0;

        $averageScore = QuizAttempt::where('user_id', $userId)->avg('score');
        $averageScore = $averageScore ? round($averageScore) : 0;

        $completedVideos = VideoProgress::where('user_id', $userId)
            ->where('is_completed', true)
            ->distinct('video_id')
            ->count('video_id');

        $totalVideos = Video::count();

        $videoProgressPercentage = $totalVideos > 0
            ? round(($completedVideos / $totalVideos) * 100)
            : 0;

        $learningHistories = QuizAttempt::with('quiz')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        $videoHistories = VideoProgress::with('video')
            ->where('user_id', $userId)
            ->where('is_completed', true)
            ->latest('completed_at')
            ->take(5)
            ->get();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weeklyAttempts = QuizAttempt::where('user_id', $userId)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw("DAYOFWEEK(created_at) as day_number, COUNT(*) as total")
            ->groupBy('day_number')
            ->pluck('total', 'day_number')
            ->toArray();

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

        $activityDates = QuizAttempt::where('user_id', $userId)
            ->selectRaw('DATE(created_at) as activity_date')
            ->distinct()
            ->orderByDesc('activity_date')
            ->pluck('activity_date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
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

        $hasPerfectScore = QuizAttempt::where('user_id', $userId)
            ->where('score', 100)
            ->exists();

        $rewards = [];

        if ($completedQuizzes >= 1) {
            $rewards[] = [
                'icon' => '⭐',
                'title' => 'Quiz Pertama',
                'description' => 'Didapat setelah menyelesaikan quiz pertama.'
            ];
        }

        if ($hasPerfectScore) {
            $rewards[] = [
                'icon' => '💯',
                'title' => 'Nilai Sempurna',
                'description' => 'Didapat setelah memperoleh nilai 100 pada quiz.'
            ];
        }

        if ($progressPercentage >= 100) {
            $rewards[] = [
                'icon' => '🎯',
                'title' => 'Progress Master',
                'description' => 'Didapat setelah menyelesaikan seluruh quiz yang tersedia.'
            ];
        }

        if ($completedVideos >= 3) {
            $rewards[] = [
                'icon' => '📚',
                'title' => 'Pembelajar Aktif',
                'description' => 'Berhasil menyelesaikan 3 materi video.'
            ];
        }

        if ($averageScore >= 70) {
            $rewards[] = [
                'icon' => '🏆',
                'title' => 'Nilai Konsisten',
                'description' => 'Mencapai rata-rata nilai minimal 70.'
            ];
        }

        if ($streakDays >= 7) {
            $rewards[] = [
                'icon' => '🔥',
                'title' => 'Streak Master',
                'description' => 'Belajar selama 7 hari berturut-turut.'
            ];
        }

        $nextTargets = [
            [
                'icon' => '📚',
                'title' => 'Pembelajar Aktif',
                'description' => 'Selesaikan 3 materi video.',
                'current' => $completedVideos,
                'target' => 3,
                'unit' => 'Materi',
                'is_completed' => $completedVideos >= 3,
            ],
            [
                'icon' => '🏆',
                'title' => 'Nilai Konsisten',
                'description' => 'Capai rata-rata nilai kuis 70%.',
                'current' => $averageScore,
                'target' => 70,
                'unit' => '%',
                'is_completed' => $averageScore >= 70,
            ],
            [
                'icon' => '🔥',
                'title' => 'Streak Master',
                'description' => 'Capai 7 hari aktivitas belajar.',
                'current' => $streakDays,
                'target' => 7,
                'unit' => 'Hari',
                'is_completed' => $streakDays >= 7,
            ],
        ];

        $skillSummary = collect([
            'Rata-rata Nilai Kuis' => $averageScore,
            'Progress Kuis' => $progressPercentage,
            'Progress Materi Video' => $videoProgressPercentage,
        ])->map(fn($score) => round($score));

        $upcomingDeadlines = Quiz::whereNotNull('deadline')
            ->where('deadline', '>=', now())
            ->orderBy('deadline')
            ->take(5)
            ->get();

        return view('student.dashboard', compact(
            'totalQuizzes',
            'completedQuizzes',
            'progressPercentage',
            'averageScore',
            'learningHistories',
            'videoHistories',
            'weeklyProgress',
            'streakDays',
            'rewards',
            'skillSummary',
            'upcomingDeadlines',
            'nextTargets'
        ));
    }
}