<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Materi Pembelajaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .btn-primary-custom { background: #7c3aed; border-color: #7c3aed; color: #fff; }
        .btn-primary-custom:hover { background: #6d28d9; border-color: #6d28d9; color: #fff; }
        .materi-card { background: #fff; border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-logo">Intellecta</div>
            <div class="sidebar-subtitle">Student Panel</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item"><a href="{{ route('dashboard') }}" class="sidebar-menu-link">Dashboard</a></li>
                <li class="sidebar-menu-item"><a href="{{ route('student.quizzes.index') }}" class="sidebar-menu-link">Kuis</a></li>
                <li class="sidebar-menu-item"><a href="{{ route('student.materi.index') }}" class="sidebar-menu-link active">Materi</a></li>
                <li class="sidebar-menu-item"><a href="{{ route('student.videos.index') }}" class="sidebar-menu-link">Materi Video</a></li>
                <li class="sidebar-menu-item" style="margin-top: 2rem;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-menu-link" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer; color: #ef4444;">Logout</button>
                    </form>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="content-header mb-4">
                <div class="greeting">Materi Pembelajaran</div>
                <div class="greeting-subtitle">Lihat dan unduh materi yang diunggah pengajar.</div>
            </div>

            @forelse($materiList as $materi)
                <div class="materi-card">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <h5 class="mb-1">{{ $materi->judul }}</h5>
                            @if($materi->deskripsi)
                                <p class="text-muted mb-2">{{ Str::limit($materi->deskripsi, 120) }}</p>
                            @endif
                            <small class="text-muted">
                                {{ $materi->file_name }} · {{ $materi->uploader->name }} · {{ $materi->created_at->format('d M Y') }}
                            </small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('student.materi.show', $materi) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                            <a href="{{ route('student.materi.download', $materi) }}" class="btn btn-sm btn-primary-custom">Download</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-light border">Belum ada materi tersedia.</div>
            @endforelse
        </main>
    </div>
</body>
</html>
