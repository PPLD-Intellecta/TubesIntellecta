<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Paket User</title>
</head>
<body>
    <h1>Manajemen Paket User</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('paket-user.create') }}">Tambah Paket User</a>

    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Paket</th>
            <th>Deskripsi</th>
            <th>Fitur yang Bisa Diakses</th>
            <th>Aksi</th>
        </tr>

        @forelse ($paketUsers as $paket)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $paket->nama_paket }}</td>
                <td>{{ $paket->deskripsi }}</td>
                <td>
                    @forelse ($paket->fiturs as $fitur)
                        - {{ $fitur->nama_fitur }} <br>
                    @empty
                        Belum ada fitur
                    @endforelse
                </td>
                <td>
                    <a href="{{ route('paket-user.edit', $paket->id) }}">Edit</a>

                    <form action="{{ route('paket-user.destroy', $paket->id) }}" method="POST" style="display:inline;">
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
                <td colspan="5">Belum ada data paket user.</td>
            </tr>
        @endforelse
    </table>
</body>
</html>