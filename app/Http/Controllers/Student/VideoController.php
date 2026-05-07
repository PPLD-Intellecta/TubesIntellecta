<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('student.videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        return view('student.videos.show', compact('video'));
    }
}
