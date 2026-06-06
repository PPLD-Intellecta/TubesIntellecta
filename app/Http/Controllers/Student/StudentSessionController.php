<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LiveSession;
use App\Models\SessionAttendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudentSessionController extends Controller
{
    /**
     * Display a listing of live sessions for students.
     */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'all');

        $query = LiveSession::with(['teacher', 'attendances']);

        // Filter based on tab
        if ($tab === 'upcoming') {
            $query->where('status', 'scheduled');
        } elseif ($tab === 'live') {
            $query->where('status', 'live');
        } elseif ($tab === 'past') {
            $query->where('status', 'ended');
        } else {
            // "all" tab: show scheduled, live, and ended. Omit draft and cancelled for students
            $query->whereIn('status', ['scheduled', 'live', 'ended']);
        }

        // Order by scheduled_at ASC as required
        $sessions = $query->orderBy('scheduled_at', 'asc')->get();

        return view('student.live-schedule.index', compact('sessions', 'tab'));
    }

    /**
     * Display the specified live session detail.
     */
    public function show(LiveSession $session)
    {
        // Don't let students view drafts or cancelled sessions directly
        if (in_array($session->status, ['draft', 'cancelled'])) {
            abort(404, 'Kelas live tidak ditemukan atau telah dibatalkan.');
        }

        $session->load(['teacher', 'attendances']);
        
        // Check if current student has already joined/marked attendance
        $hasJoined = SessionAttendance::where('session_id', $session->id)
            ->where('student_id', auth()->id())
            ->exists();

        return view('student.live-sessions.show', compact('session', 'hasJoined'));
    }

    /**
     * Mark attendance for a student and return the meeting link.
     */
    public function join(LiveSession $session)
    {
        // Check if session status is scheduled or live
        if (!in_array($session->status, ['scheduled', 'live'])) {
            return response()->json([
                'success' => false,
                'message' => 'Kelas live ini belum dimulai atau sudah berakhir.'
            ], 400);
        }

        // Check if session has max participants limit
        if ($session->max_participants) {
            $currentParticipants = SessionAttendance::where('session_id', $session->id)->count();
            $alreadyJoined = SessionAttendance::where('session_id', $session->id)
                ->where('student_id', auth()->id())
                ->exists();

            if (!$alreadyJoined && $currentParticipants >= $session->max_participants) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, kuota peserta kelas ini sudah penuh.'
                ], 400);
            }
        }

        // Create attendance record (idempotent using firstOrCreate)
        $attendance = SessionAttendance::firstOrCreate([
            'session_id' => $session->id,
            'student_id' => auth()->id(),
        ], [
            'joined_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'meeting_link' => $session->meeting_link,
            'attendance_count' => SessionAttendance::where('session_id', $session->id)->count(),
            'message' => 'Kehadiran Anda berhasil dicatat!'
        ]);
    }
}
