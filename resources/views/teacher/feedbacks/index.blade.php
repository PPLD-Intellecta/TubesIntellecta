<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Kelola Feedback</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .btn-primary { background: #7c3aed; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; }
        .feedback-table { width: 100%; border-collapse: collapse; background: white; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .feedback-table th, .feedback-table td { padding: 0.875rem 1rem; text-align: left; border-bottom: 1px solid #e5e7eb; font-size: 0.875rem; }
        .feedback-table th { background: #f9fafb; color: #6b7280; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.04em; }
        .badge-read { background: #dcfce7; color: #166534; padding: 0.2rem 0.55rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
        .badge-unread { background: #fef3c7; color: #92400e; padding: 0.2rem 0.55rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
    </style>
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
            <div class="content-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div class="greeting">Kelola Feedback</div>
                    <div class="greeting-subtitle">Daftar feedback yang pernah Anda kirim ke murid.</div>
                </div>
                <a href="{{ route('teacher.feedbacks.create') }}" class="btn-primary">+ Buat Feedback</a>
            </div>

            @if (session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="overflow-x:auto;">
                <table class="feedback-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Siswa</th>
                            <th>Kuis</th>
                            <th>Nilai</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->title }}</td>
                                <td>{{ $feedback->student->name }}</td>
                                <td>{{ $feedback->quiz?->title ?? '—' }}</td>
                                <td>{{ $feedback->score !== null ? rtrim(rtrim(number_format($feedback->score, 2, '.', ''), '0'), '.') : '—' }}</td>
                                <td>
                                    @if ($feedback->is_read)
                                        <span class="badge-read">Sudah dibaca</span>
                                    @else
                                        <span class="badge-unread">Belum dibaca</span>
                                    @endif
                                </td>
                                <td>{{ $feedback->created_at->format('d M Y H:i') }}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{ route('teacher.feedbacks.show', $feedback) }}" style="color:#7c3aed; margin-right: 0.5rem;">Detail</a>
                                    <a href="{{ route('teacher.feedbacks.edit', $feedback) }}" style="color:#374151; margin-right: 0.5rem;">Edit</a>
                                    <form action="{{ route('teacher.feedbacks.destroy', $feedback) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus feedback ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border:none; background:none; color:#dc2626; cursor:pointer;">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center; color:#6b7280;">Belum ada feedback yang dikirim.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
