@extends('layouts.app')

@section('content')
<div class="card" style="width: 100%; max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
    <h2 style="margin-top: 0; margin-bottom: 24px; color: #1e293b; font-size: 24px;">Tambah Berita Baru</h2>

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Judul Berita *</label>
            <input type="text" name="title" value="{{ old('title') }}" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#cbd5e1'">
            @error('title')
                <div style="color: #ef4444; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Isi Berita *</label>
            <textarea name="content" rows="8" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; resize: vertical; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#cbd5e1'">{{ old('content') }}</textarea>
            @error('content')
                <div style="color: #ef4444; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Gambar Cover (Opsional)</label>
            <input type="file" name="image" accept="image/*" style="width: 100%; padding: 10px; border: 1px dashed #cbd5e1; border-radius: 8px; background-color: #f8fafc;">
            <small style="color: #94a3b8; display: block; margin-top: 5px;">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
            @error('image')
                <div style="color: #ef4444; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Tanggal Publish (Opsional)</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none;">
            <small style="color: #94a3b8; display: block; margin-top: 5px;">Kosongkan jika ingin disimpan sebagai draft atau dipublish nanti.</small>
            @error('published_at')
                <div style="color: #ef4444; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 15px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
            <button type="submit" class="btn" style="background-color: #2563eb; color: white; padding: 12px 24px; border-radius: 8px; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#1d4ed8'" onmouseout="this.style.backgroundColor='#2563eb'">Simpan Berita</button>
            <a href="{{ route('admin.news.index') }}" style="padding: 12px 24px; color: #64748b; text-decoration: none; font-weight: 600; border-radius: 8px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9'" onmouseout="this.style.backgroundColor='transparent'">Batal</a>
        </div>
    </form>
</div>
@endsection
