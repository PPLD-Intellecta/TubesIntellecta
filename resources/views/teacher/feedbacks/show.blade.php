<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Detail Feedback</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-logo">Intellecta</div>
            <div class="sidebar-subtitle">Teacher Panel</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item"><a href="{{ route('teacher.quizzes.index') }}" class="sidebar-menu-link">Kelola Kuis</a></li>
                <li class="sidebar-menu-item"><a href="{{ route('teacher.feedbacks.index') }}" class="sidebar-menu-link active">Feedback</a></li>
                <li class="sidebar-menu-item" style="margin-top: 2rem;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-menu-link" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer; color: #ef4444;">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="content-header" style="display:flex; justify-content:space-between; align-items:center;">
                <div class="greeting">Detail Feedback</div>
                <div>
                    <a href="{{ route('teacher.feedbacks.edit', $feedback) }}" style="margin-right: 0.75rem; color:#7c3aed;">Edit</a>
                    <a href="{{ route('teacher.feedbacks.index') }}" style="color:#4b5563;">Kembali</a>
                </div>
            </div>

            @if (session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 900px;">
                <h3 style="margin-top:0; font-size:1.2rem;">{{ $feedback->title }}</h3>
                <p style="color:#6b7280; margin-bottom: 1.25rem;">Dikirim {{ $feedback->created_at->format('d M Y, H:i') }}</p>

                <div style="display:grid; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); gap: 1rem; margin-bottom: 1.5rem;">
                    <div><strong>Siswa:</strong><br>{{ $feedback->student->name }}</div>
                    <div>
                        <strong>Status:</strong><br>
                        {{ $feedback->is_read ? 'Sudah dibaca' : 'Belum dibaca' }}
                    </div>
                    <div><strong>Kuis Terkait:</strong><br>{{ $feedback->quiz?->title ?? 'Feedback umum' }}</div>
                    <div><strong>Nilai Evaluasi:</strong><br>{{ $feedback->score !== null ? rtrim(rtrim(number_format($feedback->score, 2, '.', ''), '0'), '.') : '—' }}</div>
                </div>

                <div>
                    <strong>Komentar/Masukan:</strong>
                    <div style="margin-top:0.5rem; background:#f9fafb; border:1px solid #e5e7eb; border-radius:0.5rem; padding:1rem; white-space:pre-wrap;">{{ $feedback->message }}</div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
