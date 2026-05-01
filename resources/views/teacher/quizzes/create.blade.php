<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Buat Kuis</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: 500; margin-bottom: 0.5rem; color: #374151; }
        .form-input, .form-textarea { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit; }
        .btn-primary { background: #7c3aed; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">Intellecta</div>
            <div class="sidebar-subtitle">Teacher Panel</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item"><a href="{{ route('teacher.quizzes.index') }}" class="sidebar-menu-link active">Kelola Kuis</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-header">
                <div class="greeting">Buat Kuis Baru</div>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <form action="{{ route('teacher.quizzes.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Judul Kuis</label>
                        <input type="text" name="title" class="form-input" required placeholder="Contoh: Kuis Pemrograman Web Dasar">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-textarea" rows="4" placeholder="Deskripsi kuis..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Simpan Kuis</button>
                    <a href="{{ route('teacher.quizzes.index') }}" style="margin-left: 1rem; color: #6b7280; text-decoration: none;">Batal</a>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
