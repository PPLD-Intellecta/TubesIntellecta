<!DOCTYPE html>
<html>
<head>
    <title>Tambah Paket User</title>
</head>
<body>
    <h1>Tambah Paket User</h1>

    <form action="{{ route('paket-user.store') }}" method="POST">
        @csrf

        <label>Nama Paket</label>
        <br>
        <input type="text" name="nama_paket" placeholder="Contoh: Free / Premium">

        <br><br>

        <label>Deskripsi</label>
        <br>
        <textarea name="deskripsi" placeholder="Contoh: Paket untuk user premium"></textarea>

        <br><br>

        <label>Pilih Fitur yang Bisa Diakses</label>
        <br>

        @foreach ($fiturs as $fitur)
            <input type="checkbox" name="fitur[]" value="{{ $fitur->id }}">
            {{ $fitur->nama_fitur }}
            <br>
        @endforeach

        <br>

        <button type="submit">Simpan</button>
        <a href="{{ route('paket-user.index') }}">Kembali</a>
    </form>
</body>
</html>