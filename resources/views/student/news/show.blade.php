@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('student.news.index') }}" style="color: #64748b; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
            &larr; Kembali ke Daftar Berita
        </a>
    </div>

    <div class="card" style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden;">
        @if($news->image)
            <div style="width: 100%; max-height: 400px; overflow: hidden;">
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" style="width: 100%; height: auto; object-fit: cover;">
            </div>
        @endif
        
        <div style="padding: 40px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <div style="color: #64748b; font-size: 14px; display: flex; align-items: center; gap: 6px;">
                    📅 {{ $news->published_at ? $news->published_at->format('d F Y, H:i') : $news->created_at->format('d F Y, H:i') }}
                </div>
            </div>

            <h1 style="margin: 0 0 24px 0; color: #1e293b; font-size: 32px; line-height: 1.3;">
                {{ $news->title }}
            </h1>

            <div style="color: #334155; font-size: 16px; line-height: 1.8;">
                {!! nl2br(e($news->content)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
