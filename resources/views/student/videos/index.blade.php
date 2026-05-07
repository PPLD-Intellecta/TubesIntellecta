@extends('layouts.app')

@section('content')
<div style="width: 100%;">
    <h2 style="margin-top: 0;">Daftar Materi Video</h2>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
        @forelse ($videos as $video)
        <div class="card" style="margin-bottom: 0;">
            <h3 style="margin-top: 0; color: #1e293b;">{{ $video->title }}</h3>
            <p style="color: #64748b; font-size: 14px; line-height: 1.5; height: 42px; overflow: hidden;">{{ Str::limit($video->description, 80) }}</p>
            <div style="margin-top: 15px;">
                <a href="{{ route('student.videos.show', $video->id) }}" class="btn" style="text-decoration: none; display: inline-block;">Tonton Video</a>
            </div>
        </div>
        @empty
        <div class="card" style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748b;">
            Belum ada materi video yang tersedia saat ini.
        </div>
        @endforelse
    </div>
</div>
@endsection
