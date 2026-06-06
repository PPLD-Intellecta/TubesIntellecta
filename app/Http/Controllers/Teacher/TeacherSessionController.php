<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\LiveSession;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TeacherSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = LiveSession::where('teacher_id', auth()->id())
            ->orderBy('scheduled_at', 'desc')
            ->get();

        return view('teacher.live-sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.live-sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform' => 'required|in:google_meet,zoom,microsoft_teams,other',
            'meeting_link' => 'required|url',
            'scheduled_at' => 'required|date|after:now',
            'duration_minutes' => 'required|integer|min:15|max:300',
            'max_participants' => 'nullable|integer|min:1',
        ], [
            'meeting_link.url' => 'Format tautan pertemuan (URL) tidak valid.',
            'scheduled_at.after' => 'Jadwal kelas live harus berada di waktu masa depan.',
        ]);

        // Parse scheduled_at in the user's timezone (Asia/Jakarta) and convert to UTC for storage
        $scheduledAtUtc = Carbon::parse($request->scheduled_at, 'Asia/Jakarta')->setTimezone('UTC');

        LiveSession::create([
            'teacher_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'platform' => $request->platform,
            'meeting_link' => $request->meeting_link,
            'scheduled_at' => $scheduledAtUtc,
            'duration_minutes' => $request->duration_minutes,
            'max_participants' => $request->max_participants,
            'status' => 'scheduled', // Auto-set status to scheduled as required
        ]);

        return redirect()->route('teacher.live-sessions.index')
            ->with('success', 'Jadwal kelas live berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LiveSession $session)
    {
        // Authorize that the session belongs to this teacher
        if ($session->teacher_id !== auth()->id()) {
            abort(403, 'Anda tidak diizinkan mengubah kelas live ini.');
        }

        // Convert the stored UTC scheduled_at back to local time for the HTML datetime-local input (which uses Y-m-d\TH:i format)
        $localScheduledAt = $session->scheduled_at->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i');

        return view('teacher.live-sessions.edit', compact('session', 'localScheduledAt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LiveSession $session)
    {
        if ($session->teacher_id !== auth()->id()) {
            abort(403, 'Anda tidak diizinkan mengubah kelas live ini.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform' => 'required|in:google_meet,zoom,microsoft_teams,other',
            'meeting_link' => 'required|url',
            'scheduled_at' => 'required|date|after:now',
            'duration_minutes' => 'required|integer|min:15|max:300',
            'max_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,scheduled,live,ended,cancelled',
        ], [
            'meeting_link.url' => 'Format tautan pertemuan (URL) tidak valid.',
            'scheduled_at.after' => 'Jadwal kelas live harus berada di waktu masa depan.',
        ]);

        $scheduledAtUtc = Carbon::parse($request->scheduled_at, 'Asia/Jakarta')->setTimezone('UTC');

        $session->update([
            'title' => $request->title,
            'description' => $request->description,
            'platform' => $request->platform,
            'meeting_link' => $request->meeting_link,
            'scheduled_at' => $scheduledAtUtc,
            'duration_minutes' => $request->duration_minutes,
            'max_participants' => $request->max_participants,
            'status' => $request->status,
        ]);

        return redirect()->route('teacher.live-sessions.index')
            ->with('success', 'Jadwal kelas live berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LiveSession $session)
    {
        if ($session->teacher_id !== auth()->id()) {
            abort(403, 'Anda tidak diizinkan menghapus kelas live ini.');
        }

        $session->delete();

        return redirect()->route('teacher.live-sessions.index')
            ->with('success', 'Kelas live berhasil dihapus.');
    }
}
