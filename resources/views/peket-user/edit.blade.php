<!DOCTYPE html>
<html>
<head>
    <title>Edit Paket User</title>
</head>
<body>
    <h1>Edit Paket User</h1>

    <form action="{{ route('paket-user.update', $paketUser->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Paket</label>
        <br>
        <input type="text" name="nama_paket" value="{{ $paketUser->nama_paket }}">

        <br><br>

        <label>Deskripsi</label>
        <br>
        <textarea name="deskripsi">{{ $paketUser->deskripsi }}</textarea>

        <br><br>

        <label>Pilih Fitur yang Bisa Diakses</label>
        <br>

        @foreach ($fiturs as $fitur)
            <input 
                type="checkbox" 
                name="fitur[]" 
                value="{{ $fitur->id }}"
                {{ $paketUser->fiturs->contains($fitur->id) ? 'checked' : '' }}
            >
            {{ $fitur->nama_fitur }}
            <br>
        @endforeach

        <br>

        <button type="submit">Update</button>
        <a href="{{ route('paket-user.index') }}">Kembali</a>
    </form>
</body>
</html>