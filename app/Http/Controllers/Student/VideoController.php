<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoProgress;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();

        return view('student.videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        $progress = VideoProgress::where('user_id', auth()->id())
            ->where('video_id', $video->id)
            ->first();

        return view('student.videos.show', compact('video', 'progress'));
    }

    public function complete(Video $video)
{
    $progress = VideoProgress::firstOrNew([
        'user_id' => auth()->id(),
        'video_id' => $video->id,
    ]);

    // Jika sudah selesai, batalkan status selesai
    if ($progress->exists && $progress->is_completed) {
        $progress->is_completed = false;
        $progress->completed_at = null;
        $progress->save();

        return redirect()
            ->route('student.videos.show', $video->id)
            ->with('success', 'Status selesai materi dibatalkan.');
    }

    // Jika belum selesai, tandai selesai
    $progress->is_completed = true;
    $progress->completed_at = now();
    $progress->save();

    return redirect()
        ->route('student.videos.show', $video->id)
        ->with('success', 'Materi berhasil ditandai selesai.');
}

}