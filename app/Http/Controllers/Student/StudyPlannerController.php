<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudyGoal;
use App\Models\DailyCheckin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudyPlannerDay
{
    public $date;
    public $goals;

    public function __construct(Carbon $date, $goals)
    {
        $this->date = $date;
        $this->goals = $goals;
    }

    public function isToday(): bool
    {
        return $this->date->timezone('Asia/Jakarta')->isToday();
    }
}

class StudyPlannerController extends Controller
{
    /**
     * Display the study planner page for the current student.
     */
    public function index(Request $request)
    {
        $studentId = auth()->id();
        $todayStr = Carbon::now('Asia/Jakarta')->toDateString();

        // 1. Auto-mark pending/in_progress goals whose target_date has passed as overdue
        StudyGoal::where('student_id', $studentId)
            ->where('target_date', '<', $todayStr)
            ->whereIn('status', ['pending', 'in_progress'])
            ->update(['status' => 'overdue']);

        // 2. Determine start and end of the current week (Sunday to Saturday)
        $startOfWeek = Carbon::now('Asia/Jakarta')->startOfWeek(Carbon::SUNDAY);
        $endOfWeek = $startOfWeek->copy()->addDays(6);

        $startDate = $startOfWeek->toDateString();
        $endDate = $endOfWeek->toDateString();

        // 3. Eager load goals for the week and group them by date
        $goalsForWeek = StudyGoal::where('student_id', $studentId)
            ->whereBetween('target_date', [$startDate, $endDate])
            ->orderBy('target_date', 'asc')
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->get()
            ->groupBy(function($goal) {
                return $goal->target_date->toDateString();
            });

        // 4. Build $weekDays array of StudyPlannerDay objects
        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $dayDate = $startOfWeek->copy()->addDays($i);
            $dayDateStr = $dayDate->toDateString();
            $dayGoals = $goalsForWeek->get($dayDateStr, collect([]));
            $weekDays[] = new StudyPlannerDay($dayDate, $dayGoals);
        }

        // 5. Fetch all goals of the week for listing in the task panel
        $goals = StudyGoal::where('student_id', $studentId)
            ->whereBetween('target_date', [$startDate, $endDate])
            ->orderBy('target_date', 'asc')
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->get();

        // 6. Calculate stats
        $totalGoals = $goals->count();
        $completedGoals = $goals->where('status', 'completed')->count();
        
        // Sum study_minutes of completed goals this week
        $totalStudyMinutes = $goals->where('status', 'completed')->sum('estimated_minutes');

        // 7. Calculate Streak (consecutive days with completed checkin, backwards from today or yesterday)
        $streak = $this->calculateStreak($studentId);

        return view('student.planner.index', compact(
            'weekDays',
            'goals',
            'totalGoals',
            'completedGoals',
            'totalStudyMinutes',
            'streak'
        ));
    }

    /**
     * Store a newly created study goal.
     */
    public function storeGoal(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'estimated_minutes' => 'required|integer|min:5|max:1440',
        ]);

        $studentId = auth()->id();

        StudyGoal::create([
            'student_id' => $studentId,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'target_date' => $request->input('target_date'),
            'priority' => $request->input('priority'),
            'status' => 'pending',
            'estimated_minutes' => $request->input('estimated_minutes'),
        ]);

        return redirect()->route('student.planner.index')->with('success', 'Target belajar berhasil ditambahkan!');
    }

    /**
     * Update an existing study goal.
     */
    public function updateGoal(Request $request, StudyGoal $goal)
    {
        // Authorize student ownership
        if ($goal->student_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'estimated_minutes' => 'required|integer|min:5|max:1440',
        ]);

        $goal->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'target_date' => $request->input('target_date'),
            'priority' => $request->input('priority'),
            'estimated_minutes' => $request->input('estimated_minutes'),
        ]);

        // If target date changes and status is overdue but target is future, revert to pending
        $todayStr = Carbon::now('Asia/Jakarta')->toDateString();
        if ($goal->target_date->toDateString() >= $todayStr && $goal->status === 'overdue') {
            $goal->update(['status' => 'pending']);
        }

        return redirect()->route('student.planner.index')->with('success', 'Target belajar berhasil diperbarui!');
    }

    /**
     * Delete a study goal.
     */
    public function destroyGoal(StudyGoal $goal)
    {
        // Authorize student ownership
        if ($goal->student_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $targetDate = $goal->target_date->toDateString();
        $goal->delete();

        // Sync checkin for that date (in case we deleted the only completed goal)
        $this->syncDailyCheckin(auth()->id(), $targetDate);

        return redirect()->route('student.planner.index')->with('success', 'Target belajar berhasil dihapus!');
    }

    /**
     * Toggle status of a goal (AJAX request).
     */
    public function toggleGoal(Request $request, StudyGoal $goal)
    {
        // Authorize student ownership
        if ($goal->student_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $completed = $request->input('completed', false);

        if ($completed) {
            $goal->status = 'completed';
            $goal->completed_at = Carbon::now();
        } else {
            // Revert to pending (or overdue if target_date passed)
            $todayStr = Carbon::now('Asia/Jakarta')->toDateString();
            if ($goal->target_date->toDateString() < $todayStr) {
                $goal->status = 'overdue';
            } else {
                $goal->status = 'pending';
            }
            $goal->completed_at = null;
        }
        $goal->save();

        // Sync the daily checkin for this target date
        $this->syncDailyCheckin(auth()->id(), $goal->target_date->toDateString());

        // Recalculate streak
        $streak = $this->calculateStreak(auth()->id());

        // Recalculate stats for the current week
        $startOfWeek = Carbon::now('Asia/Jakarta')->startOfWeek(Carbon::SUNDAY);
        $endOfWeek = $startOfWeek->copy()->addDays(6);

        $goalsThisWeek = StudyGoal::where('student_id', auth()->id())
            ->whereBetween('target_date', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->get();

        $totalGoals = $goalsThisWeek->count();
        $completedGoals = $goalsThisWeek->where('status', 'completed')->count();
        $totalStudyMinutes = $goalsThisWeek->where('status', 'completed')->sum('estimated_minutes');

        return response()->json([
            'success' => true,
            'status' => $goal->status,
            'streak' => $streak,
            'completed' => $completedGoals,
            'total' => $totalGoals,
            'minutes' => $totalStudyMinutes
        ]);
    }

    /**
     * Store/Update a manual daily checkin.
     */
    public function storeCheckin(Request $request)
    {
        $request->validate([
            'checkin_date' => 'required|date',
            'study_minutes' => 'required|integer|min:0|max:1440',
            'notes' => 'nullable|string',
        ]);

        $studentId = auth()->id();
        $date = $request->input('checkin_date');
        $studyMinutes = $request->input('study_minutes');
        $notes = $request->input('notes');

        DailyCheckin::updateOrCreate(
            ['student_id' => $studentId, 'checkin_date' => $date],
            [
                'is_completed' => $studyMinutes > 0,
                'study_minutes' => $studyMinutes,
                'notes' => $notes,
            ]
        );

        return redirect()->route('student.planner.index')->with('success', 'Check-in harian berhasil disimpan!');
    }

    /**
     * Fetch calendar data for AJAX usage.
     */
    public function calendarData(Request $request)
    {
        $studentId = auth()->id();
        $start = $request->query('start');
        $end = $request->query('end');

        if (!$start || !$end) {
            $startOfWeek = Carbon::now('Asia/Jakarta')->startOfWeek(Carbon::SUNDAY);
            $endOfWeek = $startOfWeek->copy()->addDays(6);
            $start = $startOfWeek->toDateString();
            $end = $endOfWeek->toDateString();
        }

        $goals = StudyGoal::where('student_id', $studentId)
            ->whereBetween('target_date', [$start, $end])
            ->get();

        return response()->json([
            'success' => true,
            'start' => $start,
            'end' => $end,
            'goals' => $goals
        ]);
    }

    /**
     * Sync daily checkin record for a date based on completed goals.
     */
    private function syncDailyCheckin($studentId, $dateStr)
    {
        $completedGoals = StudyGoal::where('student_id', $studentId)
            ->where('target_date', $dateStr)
            ->where('status', 'completed')
            ->get();

        $isCompleted = $completedGoals->count() > 0;
        $totalMinutes = $completedGoals->sum('estimated_minutes');

        if ($isCompleted) {
            DailyCheckin::updateOrCreate(
                ['student_id' => $studentId, 'checkin_date' => $dateStr],
                [
                    'is_completed' => true,
                    'study_minutes' => $totalMinutes,
                ]
            );
        } else {
            // Check if there is an existing checkin with manual notes or minutes.
            // If they had manual minutes, we might preserve it. If they had none, we can mark it not completed.
            $existing = DailyCheckin::where('student_id', $studentId)
                ->where('checkin_date', $dateStr)
                ->first();

            if ($existing) {
                // If it was created automatically (no notes and study_minutes equals total minutes before toggle)
                // we set is_completed to false and minutes to 0
                if (empty($existing->notes)) {
                    $existing->update([
                        'is_completed' => false,
                        'study_minutes' => 0
                    ]);
                }
            }
        }
    }

    /**
     * Calculate consecutive days study streak in Asia/Jakarta timezone.
     */
    private function calculateStreak($studentId): int
    {
        $todayStr = Carbon::now('Asia/Jakarta')->toDateString();
        $yesterdayStr = Carbon::now('Asia/Jakarta')->subDay()->toDateString();

        // 1. Check if today is completed
        $hasToday = DailyCheckin::where('student_id', $studentId)
            ->where('checkin_date', $todayStr)
            ->where('is_completed', true)
            ->exists();

        // 2. Check if yesterday is completed
        $hasYesterday = DailyCheckin::where('student_id', $studentId)
            ->where('checkin_date', $yesterdayStr)
            ->where('is_completed', true)
            ->exists();

        if (!$hasToday && !$hasYesterday) {
            return 0;
        }

        // Start counting back from the latest completed day (today or yesterday)
        $currentDate = $hasToday ? Carbon::now('Asia/Jakarta') : Carbon::now('Asia/Jakarta')->subDay();
        $streak = 0;

        while (true) {
            $checkin = DailyCheckin::where('student_id', $studentId)
                ->where('checkin_date', $currentDate->toDateString())
                ->where('is_completed', true)
                ->exists();

            if ($checkin) {
                $streak++;
                $currentDate->subDay();
            } else {
                break;
            }
        }

        return $streak;
    }
}
