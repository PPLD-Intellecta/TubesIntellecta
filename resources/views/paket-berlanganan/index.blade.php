<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Paket Berlangganan</title>
</head>
<body>
    <h1>Manajemen Paket Berlangganan</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('paket-berlangganan.create') }}">
        Tambah Paket
    </a>

    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Durasi Hari</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($paket as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_paket }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->durasi_hari }} hari</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>
                        @if ($item->status == 1)
                            Aktif
                        @else
                            Tidak Aktif
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('paket-berlangganan.edit', $item->id) }}">
                            Edit
                        </a>

                        <form action="{{ route('paket-berlangganan.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Yakin ingin menghapus paket ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data paket.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>