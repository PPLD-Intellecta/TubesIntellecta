<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Edit Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .btn-primary-custom { background: #7c3aed; border-color: #7c3aed; color: #fff; }
        .btn-primary-custom:hover { background: #6d28d9; border-color: #6d28d9; color: #fff; }
        .form-card { background: #fff; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('teacher.partials.sidebar', ['active' => 'materi'])

        <main class="main-content">
            <div class="content-header mb-4">
                <div class="greeting">Edit Materi</div>
                <div class="greeting-subtitle">Perbarui informasi atau ganti file materi.</div>
            </div>

            <div class="form-card">
                <form action="{{ route('teacher.materi.update', $materi) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Materi</label>
                        <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $materi->judul) }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Saat Ini</label>
                        <p class="text-muted mb-2">{{ $materi->file_name }}</p>
                        <label for="file_materi" class="form-label">Ganti File (opsional)</label>
                        <input type="file" id="file_materi" name="file_materi" class="form-control @error('file_materi') is-invalid @enderror" accept=".pdf,.doc,.docx,.ppt,.pptx">
                        <div class="form-text">Format: PDF, DOC, DOCX, PPT, PPTX. Maksimal 20 MB.</div>
                        @error('file_materi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-custom">Simpan Perubahan</button>
                        <a href="{{ route('teacher.materi.show', $materi) }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
