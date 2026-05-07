@extends('layouts.app')

@section('content')
<div class="card" style="width: 100%; max-width: 600px; margin: 0 auto;">
    <h2 style="margin-top: 0; margin-bottom: 20px;">Tambah Video Baru</h2>

    <form action="{{ route('admin.videos.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Judul Video</label>
            <input type="text" name="title" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Deskripsi</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;"></textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">URL Video (YouTube / GDrive dsb)</label>
            <input type="url" name="url_video" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" placeholder="https://...">
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn">Simpan Video</button>
            <a href="{{ route('admin.videos.index') }}" style="padding: 8px 12px; color: #64748b; text-decoration: none;">Batal</a>
        </div>
    </form>
</div>
@endsection
