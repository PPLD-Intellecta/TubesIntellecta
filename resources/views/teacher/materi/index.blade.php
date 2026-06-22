<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Daftar Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .btn-primary-custom { background: #7c3aed; border-color: #7c3aed; color: #fff; }
        .btn-primary-custom:hover { background: #6d28d9; border-color: #6d28d9; color: #fff; }
        .materi-table { background: #fff; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .materi-table th { background: #f9fafb; color: #6b7280; font-size: 0.75rem; text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('teacher.partials.sidebar', ['active' => 'materi'])

        <main class="main-content">
            <div class="content-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <div class="greeting">Daftar Materi</div>
                    <div class="greeting-subtitle">Kelola materi pembelajaran untuk siswa.</div>
                </div>
                <a href="{{ route('teacher.materi.create') }}" class="btn btn-primary-custom">+ Tambah Materi</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table materi-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>File</th>
                            <th>Diunggah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materiList as $materi)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $materi->judul }}</div>
                                    @if($materi->deskripsi)
                                        <small class="text-muted">{{ Str::limit($materi->deskripsi, 60) }}</small>
                                    @endif
                                </td>
                                <td>{{ $materi->file_name }}</td>
                                <td>{{ $materi->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="{{ route('teacher.materi.show', $materi) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                                        <a href="{{ route('teacher.materi.edit', $materi) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="{{ route('teacher.materi.download', $materi) }}" class="btn btn-sm btn-outline-success">Download</a>
                                        <form action="{{ route('teacher.materi.destroy', $materi) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada materi. Silakan unggah materi pertama Anda.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
