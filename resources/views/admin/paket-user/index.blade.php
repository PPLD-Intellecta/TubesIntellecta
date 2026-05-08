<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Paket User - Intellecta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: #ead8ff;
            padding: 28px 30px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .brand {
            margin-bottom: 34px;
        }

        .brand h1 {
            margin: 0;
            color: #7c3aed;
            font-size: 28px;
            font-weight: 800;
        }

        .brand p {
            margin: 8px 0 0;
            color: #a855f7;
            font-size: 14px;
        }

        .year {
            color: #7e22ce;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .menu a {
            text-decoration: none;
            color: #7e22ce;
            padding: 14px 18px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 500;
        }

        .menu a:hover,
        .menu a.active {
            background: #ddc3ff;
            color: #6d28d9;
            font-weight: 700;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 18px;
        }

        .sidebar-divider {
            border: none;
            border-top: 1px solid #d8b4fe;
            margin: 28px 0;
        }

        .pro-box {
            background: #ddc3ff;
            color: #6d28d9;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .upgrade-btn {
            display: block;
            background: #22c7df;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 999px;
            padding: 12px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .logout-form {
            margin: 0;
        }

        .logout-button {
            border: none;
            background: transparent;
            color: #ef4444;
            padding: 12px 0;
            font-size: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .main {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 42px 36px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 34px;
            font-weight: 800;
            color: #0f172a;
        }

        .page-header p {
            margin: 10px 0 0;
            color: #475569;
            font-size: 16px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 330px;
            gap: 24px;
            align-items: start;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 28px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
            border: 1px solid #f1f5f9;
        }

        .card-title {
            margin: 0 0 22px;
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert {
            background: #dcfce7;
            color: #166534;
            border-radius: 10px;
            padding: 14px 16px;
            font-weight: 700;
            margin-bottom: 22px;
        }

        .table-wrapper {
            overflow-x: auto;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        thead th:nth-child(1),
        tbody td:nth-child(1) {
            width: 28%;
        }

        thead th:nth-child(2),
        tbody td:nth-child(2) {
            width: 40%;
        }

        thead th:nth-child(3),
        tbody td:nth-child(3),
        thead th:nth-child(4),
        tbody td:nth-child(4) {
            width: 16%;
        }
        
        thead th {
            background: #f3e8ff;
            color: #581c87;
            text-align: left;
            padding: 16px;
            font-size: 14px;
            border-bottom: 1px solid #e9d5ff;
        }

        tbody td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            color: #0f172a;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #faf5ff;
        }

        .feature-name {
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .feature-code {
            font-size: 12px;
            color: #7c3aed;
            font-weight: 700;
        }

        .desc {
            color: #475569;
            line-height: 1.5;
        }

        .center {
            text-align: center;
        }

        .paket-badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 13px;
        }

        .badge-free {
            background: #e5e7eb;
            color: #475569;
        }

        .badge-premium {
            background: #ede9fe;
            color: #6d28d9;
        }

        input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: #7c3aed;
            cursor: pointer;
        }

        .action-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 22px;
        }

        .save-btn {
            border: none;
            background: #9333ea;
            color: white;
            padding: 13px 26px;
            border-radius: 999px;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #7e22ce;
        }

        .summary-card h3 {
            margin: 0 0 20px;
            font-size: 22px;
        }

        .summary-box {
            background: #f3e8ff;
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 14px;
            color: #475569;
        }

        .summary-item:last-child {
            margin-bottom: 0;
        }

        .summary-value {
            color: #0f172a;
            font-weight: 800;
            font-size: 18px;
        }

        .info-box {
            background: #0f172a;
            color: white;
            border-radius: 10px;
            padding: 18px;
        }

        .info-box small {
            color: #94a3b8;
            font-weight: 700;
        }

        .info-box h4 {
            margin: 12px 0;
            color: white;
        }

        .info-box p {
            color: #cbd5e1;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .note {
            margin-top: 18px;
            background: #fef9c3;
            color: #854d0e;
            border-radius: 10px;
            padding: 14px 16px;
            font-size: 14px;
            line-height: 1.5;
        }

        @media (max-width: 1100px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .layout {
                flex-direction: column;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <div class="brand">
            <h1>Intellecta</h1>
            <p>Panel CMS</p>
        </div>

        <div class="year">
            TAHUN BELAJAR<br>
            2024 Akademi 2024
        </div>

        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}">
                <span class="menu-icon">▦</span>
                <span>Dashboard</span>
            </a>

            <a href="#">
                <span class="menu-icon">■</span>
                <span>Kursus Saya</span>
            </a>

            <a href="#">
                <span class="menu-icon">＋</span>
                <span>Tagih</span>
            </a>

            <a href="#">
                <span class="menu-icon">●</span>
                <span>Sumber Daya</span>
            </a>

            <a href="#">
                <span class="menu-icon">■</span>
                <span>Pesan</span>
            </a>

            <a href="{{ route('admin.videos.index') }}">
                <span class="menu-icon">▶</span>
                <span>Manajemen Video</span>
            </a>

            <a href="{{ route('admin.paket-user.index') }}" class="active">
                <span class="menu-icon">◆</span>
                <span>Kelola Paket User</span>
            </a>
        </nav>

        <hr class="sidebar-divider">

        <div class="pro-box">
            ⭐ Akses Pro<br>
            <span>Beli Akses CMS</span>
        </div>

        <a href="#" class="upgrade-btn">
            ↗ Tingkatkan Pro
        </a>

        <a href="#" class="menu" style="display:flex; text-decoration:none; color:#7e22ce; padding:10px 0;">
            🤝 Pusat Bantuan
        </a>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">
                <span>🚪</span>
                <span>Keluar</span>
            </button>
        </form>
    </aside>

    <main class="main">
        <div class="page-header">
            <h1>Kelola Paket User</h1>
            <p>Atur hak akses fitur untuk membedakan user Free dan Premium di ekosistem Intellecta.</p>
        </div>

        <div class="content-grid">
            <section class="card">
                <h2 class="card-title">
                    ⚙️ Pengaturan Akses Paket
                </h2>

                @if (session('success'))
                    <div class="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.paket-user.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Fitur</th>
                                    <th>Deskripsi</th>

                                    @foreach ($pakets as $paket)
                                        <th class="center">
                                            <span class="paket-badge {{ strtolower($paket->nama) === 'premium' ? 'badge-premium' : 'badge-free' }}">
                                                {{ $paket->nama }}
                                            </span>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($fiturs as $fitur)
                                    @php
                                        $namaFitur = $fitur->nama ?: $fitur->deskripsi;
                                        $kodeFitur = $fitur->kode ?: '-';
                                    @endphp

                                    <tr>
                                        <td>
                                            <div class="feature-name">
                                                {{ $namaFitur }}
                                            </div>
                                            <div class="feature-code">
                                                {{ $kodeFitur }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="desc">
                                                {{ $fitur->deskripsi }}
                                            </div>
                                        </td>

                                        @foreach ($pakets as $paket)
                                            <td class="center">
                                                <input
                                                    type="checkbox"
                                                    name="akses[{{ $paket->id }}][]"
                                                    value="{{ $fitur->id }}"
                                                    @checked($paket->fiturs->contains('id', $fitur->id))
                                                >
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="action-row">
                        <button type="submit" class="save-btn">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <div class="note">
                    Catatan: Jika admin mengubah centang fitur, maka semua user dengan paket tersebut akan mengikuti aturan akses terbaru secara otomatis.
                </div>
            </section>

            <aside class="card summary-card">
                <h3>Ringkasan Paket</h3>

                <div class="summary-box">
                    <div class="summary-item">
                        <span>Total Paket</span>
                        <span class="summary-value">{{ $pakets->count() }}</span>
                    </div>

                    <div class="summary-item">
                        <span>Total Fitur</span>
                        <span class="summary-value">{{ $fiturs->count() }}</span>
                    </div>
                </div>

                <div class="info-box">
                    <small>REKOMENDASI</small>
                    <h4>Kelola Akses Dengan Konsisten</h4>
                    <p>
                        Paket Free sebaiknya hanya berisi fitur dasar. Paket Premium dapat diberikan akses penuh seperti forum, live teaching, notifikasi, dan study planner.
                    </p>
                </div>
            </aside>
        </div>
    </main>
</div>

</body>
</html>