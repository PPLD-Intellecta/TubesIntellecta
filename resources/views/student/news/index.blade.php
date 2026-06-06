@extends('layouts.app')

@section('content')
<div style="margin-bottom: 30px;">
    <h2 style="margin: 0 0 10px 0; color: #1e293b; font-size: 28px;">Berita & Pengumuman</h2>
    <p style="color: #64748b; margin: 0;">Informasi terbaru seputar platform dan pembelajaran</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
    @forelse($news as $item)
        <div class="card" style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; display: flex; flex-direction: column; height: 100%;">
            @if($item->image)
                <div style="height: 180px; width: 100%; overflow: hidden;">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            @else
                <div style="height: 180px; width: 100%; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); display: flex; align-items: center; justify-content: center;">
                    <span style="color: white; opacity: 0.5; font-size: 48px;">📰</span>
                </div>
            @endif
            
            <div style="padding: 20px; display: flex; flex-direction: column; flex-grow: 1;">
                <div style="font-size: 13px; color: #64748b; margin-bottom: 8px;">
                    {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                </div>
                
                <h3 style="margin: 0 0 12px 0; color: #1e293b; font-size: 18px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    {{ $item->title }}
                </h3>
                
                <p style="color: #475569; margin: 0 0 20px 0; font-size: 14px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; flex-grow: 1;">
                    {{ Str::limit(strip_tags($item->content), 120) }}
                </p>
                
                <div style="margin-top: auto;">
                    <a href="{{ route('student.news.show', $item->id) }}" style="display: inline-block; color: #2563eb; font-weight: 600; text-decoration: none; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='#1d4ed8'" onmouseout="this.style.color='#2563eb'">
                        Baca Selengkapnya &rarr;
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div style="grid-column: 1 / -1; background: white; padding: 40px; border-radius: 12px; text-align: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <div style="font-size: 48px; margin-bottom: 16px;">📭</div>
            <h3 style="color: #1e293b; margin: 0 0 8px 0;">Belum Ada Berita</h3>
            <p style="color: #64748b; margin: 0;">Belum ada berita atau pengumuman yang dipublish saat ini.</p>
        </div>
    @endforelse
</div>

@if($news->hasPages())
    <div style="margin-top: 30px;">
        {{ $news->links() }}
    </div>
@endif
@endsection
