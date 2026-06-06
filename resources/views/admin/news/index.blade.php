@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="margin: 0; color: #1e293b; font-size: 24px;">Kelola Berita</h2>
    <a href="{{ route('admin.news.create') }}" class="btn" style="background-color: #2563eb; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500;">+ Tambah Berita</a>
</div>

@if(session('success'))
    <div style="background-color: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
        {{ session('success') }}
    </div>
@endif

<div class="card" style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0; text-align: left;">
                <th style="padding: 15px; color: #64748b; font-weight: 600;">Judul</th>
                <th style="padding: 15px; color: #64748b; font-weight: 600;">Tanggal Publish</th>
                <th style="padding: 15px; color: #64748b; font-weight: 600; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($news as $item)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 15px; color: #334155; font-weight: 500;">{{ $item->title }}</td>
                    <td style="padding: 15px; color: #64748b;">
                        {{ $item->published_at ? $item->published_at->format('d M Y H:i') : 'Draft' }}
                    </td>
                    <td style="padding: 15px; text-align: center;">
                        <a href="{{ route('admin.news.edit', $item->id) }}" style="color: #3b82f6; text-decoration: none; margin-right: 15px; font-weight: 500;">Edit</a>
                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-weight: 500;" onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="padding: 30px; text-align: center; color: #94a3b8;">
                        Belum ada berita yang ditambahkan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($news->hasPages())
        <div style="padding: 15px; border-top: 1px solid #e2e8f0;">
            {{ $news->links() }}
        </div>
    @endif
</div>
@endsection
