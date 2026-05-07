@extends('layouts.app')

@section('content')
<div class="card" style="width: 100%;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Manajemen Video</h2>
        <a href="{{ route('admin.videos.create') }}" class="btn" style="text-decoration: none;">Tambah Video</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                <th style="padding: 12px; text-align: left;">Judul</th>
                <th style="padding: 12px; text-align: left;">Deskripsi</th>
                <th style="padding: 12px; text-align: left;">URL Video</th>
                <th style="padding: 12px; text-align: left;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($videos as $video)
            <tr style="border-bottom: 1px solid #e2e8f0;">
                <td style="padding: 12px;">{{ $video->title }}</td>
                <td style="padding: 12px;">{{ Str::limit($video->description, 50) }}</td>
                <td style="padding: 12px;"><a href="{{ $video->url_video }}" target="_blank" style="color: #3b82f6;">Lihat</a></td>
                <td style="padding: 12px;">
                    <a href="{{ route('admin.videos.edit', $video->id) }}" style="color: #eab308; margin-right: 10px;">Edit</a>
                    <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer;" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 20px; text-align: center; color: #64748b;">Belum ada video. Silakan tambah video baru.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
