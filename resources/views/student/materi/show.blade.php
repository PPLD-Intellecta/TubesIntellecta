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
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-logo">Intellecta</div>
            <div class="sidebar-subtitle">Student Panel</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item"><a href="{{ route('student.materi.index') }}" class="sidebar-menu-link active">Materi</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="content-header mb-4">
                <div class="greeting">{{ $materi->judul }}</div>
                <div class="greeting-subtitle">Detail materi pembelajaran</div>
            </div>

            <div class="detail-card">
                <p class="mb-3">{{ $materi->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                <ul class="list-unstyled text-muted mb-4">
                    <li><strong>File:</strong> {{ $materi->file_name }}</li>
                    <li><strong>Pengajar:</strong> {{ $materi->uploader->name }}</li>
                    <li><strong>Diunggah:</strong> {{ $materi->created_at->format('d M Y H:i') }}</li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('student.materi.download', $materi) }}" class="btn btn-primary-custom">Download Materi</a>
                    <a href="{{ route('student.materi.index') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
