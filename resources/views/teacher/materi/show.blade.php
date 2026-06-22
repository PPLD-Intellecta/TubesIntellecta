<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Detail Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .btn-primary-custom { background: #7c3aed; border-color: #7c3aed; color: #fff; }
        .btn-primary-custom:hover { background: #6d28d9; border-color: #6d28d9; color: #fff; }
        .detail-card { background: #fff; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .detail-label { font-size: 0.75rem; text-transform: uppercase; color: #6b7280; letter-spacing: 0.04em; margin-bottom: 0.25rem; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('teacher.partials.sidebar', ['active' => 'materi'])

        <main class="main-content">
            <div class="content-header mb-4">
                <div class="greeting">Detail Materi</div>
                <div class="greeting-subtitle">{{ $materi->judul }}</div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="detail-card">
                <div class="mb-4">
                    <div class="detail-label">Judul</div>
                    <div class="fs-5 fw-semibold">{{ $materi->judul }}</div>
                </div>

                <div class="mb-4">
                    <div class="detail-label">Deskripsi</div>
                    <div>{{ $materi->deskripsi ?: '—' }}</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="detail-label">Nama File</div>
                        <div>{{ $materi->file_name }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-label">Diunggah Oleh</div>
                        <div>{{ $materi->uploader->name }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-label">Tanggal Upload</div>
                        <div>{{ $materi->created_at->format('d M Y H:i') }}</div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('teacher.materi.download', $materi) }}" class="btn btn-primary-custom">Download</a>
                    <a href="{{ route('teacher.materi.edit', $materi) }}" class="btn btn-outline-primary">Edit</a>
                    <a href="{{ route('teacher.materi.index') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
