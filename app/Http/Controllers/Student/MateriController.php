<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materiList = Materi::with('uploader')->latest()->get();

        return view('student.materi.index', compact('materiList'));
    }

    public function show(Materi $materi)
    {
        $materi->load('uploader');

        return view('student.materi.show', compact('materi'));
    }

    public function download(Materi $materi)
    {
        if (! Storage::disk('public')->exists($materi->file_path)) {
            abort(404, 'File materi tidak ditemukan.');
        }

        return Storage::disk('public')->download($materi->file_path, $materi->file_name);
    }
}
