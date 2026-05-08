@extends('layouts.app')

@section('content')
<div class="card" style="width: 100%;">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('student.videos.index') }}" style="color: #3b82f6; text-decoration: none;">&larr; Kembali ke Daftar Materi</a>
    </div>

    <h2 style="margin-top: 0;">{{ $video->title }}</h2>

    <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 8px; margin: 20px 0; background: #000;">
        <iframe src="{{ $video->embed_url }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <div style="margin-top: 20px;">
        <h3 style="margin-bottom: 10px;">Deskripsi Materi</h3>
        <p style="color: #475569; line-height: 1.6; white-space: pre-line;">{{ $video->description }}</p>
    </div>
</div>
@endsection
