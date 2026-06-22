<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materiList = Materi::with('uploader')
            ->where('uploaded_by', auth()->id())
            ->latest()
            ->get();

        return view('teacher.materi.index', compact('materiList'));
    }

    public function create()
    {
        return view('teacher.materi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:20480',
        ]);

        $file = $request->file('file_materi');
        $storedPath = $file->store('materi', 'public');

        Materi::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'file_path' => $storedPath,
            'file_name' => $file->getClientOriginalName(),
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()
            ->route('teacher.materi.index')
            ->with('success', 'Materi berhasil diunggah.');
    }

    public function show(Materi $materi)
    {
        $this->authorizeMateri($materi);

        $materi->load('uploader');

        return view('teacher.materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        $this->authorizeMateri($materi);

        return view('teacher.materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $this->authorizeMateri($materi);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:20480',
        ]);

        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
        ];

        if ($request->hasFile('file_materi')) {
            Storage::disk('public')->delete($materi->file_path);

            $file = $request->file('file_materi');
            $data['file_path'] = $file->store('materi', 'public');
            $data['file_name'] = $file->getClientOriginalName();
        }

        $materi->update($data);

        return redirect()
            ->route('teacher.materi.show', $materi)
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        $this->authorizeMateri($materi);

        Storage::disk('public')->delete($materi->file_path);
        $materi->delete();

        return redirect()
            ->route('teacher.materi.index')
            ->with('success', 'Materi berhasil dihapus.');
    }

    public function download(Materi $materi)
    {
        $this->authorizeMateri($materi);

        if (! Storage::disk('public')->exists($materi->file_path)) {
            abort(404, 'File materi tidak ditemukan.');
        }

        return Storage::disk('public')->download($materi->file_path, $materi->file_name);
    }

    private function authorizeMateri(Materi $materi): void
    {
        if ($materi->uploaded_by !== auth()->id()) {
            abort(403);
        }
    }
}
