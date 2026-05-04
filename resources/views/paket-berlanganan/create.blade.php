<!DOCTYPE html>
<html>
<head>
    <title>Tambah Paket Berlangganan</title>
</head>
<body>
    <h1>Tambah Paket Berlangganan</h1>

    <form action="{{ route('paket-berlangganan.store') }}" method="POST">
        @csrf

        <label>Nama Paket</label>
        <br>
        <input type="text" name="nama_paket" value="{{ old('nama_paket') }}">
        @error('nama_paket')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Harga</label>
        <br>
        <input type="number" name="harga" value="{{ old('harga') }}">
        @error('harga')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Durasi Hari</label>
        <br>
        <input type="number" name="durasi_hari" value="{{ old('durasi_hari') }}">
        @error('durasi_hari')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br><br>

        <label>Deskripsi</label>
        <br>
        <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>

        <br><br>

        <label>Status</label>
        <br>
        <select name="status">
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>

        <br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('paket-berlangganan.index') }}">Kembali</a>
    </form>
</body>
</html>