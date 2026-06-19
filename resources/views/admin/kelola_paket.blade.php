<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Kelola Paket User</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        
        <aside class="w-64 bg-gradient-to-b from-purple-100 to-purple-50 p-6 fixed h-full overflow-y-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-purple-700">Intellecta</h1>
                <p class="text-xs text-purple-600 mt-1">Panel CMS</p>
            </div>

            <div class="mb-8">
                <p class="text-xs font-semibold text-purple-600 uppercase">Tahun Belajar</p>
                <p class="text-sm text-purple-900">2026 Akademi 2026</p>
            </div>

            <nav class="space-y-3 mb-8">
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                    Kursus Saya
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    Tagih
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                    Sumber Daya
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
                    Pesan
                </a>
                <a href="{{ route('admin.videos.index') }}" class="flex items-center gap-3 px-4 py-2 text-purple-700 hover:bg-purple-100 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>
                    Manajemen Video
                </a>
                <a href="{{ route('admin.kelola-paket') }}" class="flex items-center gap-3 px-4 py-2 bg-purple-200 text-purple-700 rounded-lg font-medium text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                    Kelola Paket User
                </a>
            </nav>
        </aside>

        <main class="ml-64 flex-1 overflow-auto">
            <div class="p-8">
                
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Kelola Paket User</h1>
                    <p class="text-gray-600 text-sm mt-2">Atur hak akses fitur untuk membedakan user Free dan Premium di ekosistem Intellecta.</p>
                </div>

                <div class="grid grid-cols-3 gap-6">
                    
                    <div class="col-span-2 space-y-6">
                        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                            
                            <div class="flex items-center gap-2 mb-6 text-gray-800 font-semibold text-lg">
                                <span>⚙️</span>
                                <h2>Pengaturan Akses Paket</h2>
                            </div>

                            <form action="#" method="POST">
                                @csrf
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left">
                                        <thead>
                                            <tr class="border-b border-gray-200 text-gray-500 text-xs uppercase">
                                                <th class="py-3 px-2 font-semibold w-1/3">Nama Fitur</th>
                                                <th class="py-3 px-2 font-semibold w-1/3">Deskripsi</th>
                                                <th class="py-3 px-2 font-semibold text-center">Free</th>
                                                <th class="py-3 px-2 font-semibold text-center">Premium</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-800 divide-y divide-gray-100">
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="py-4 px-2 font-bold text-gray-900">Akses fitur quiz</td>
                                                <td class="py-4 px-2 text-gray-500 text-xs">Akses fitur quiz</td>
                                                <td class="py-4 text-center"><input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500"></td>
                                                <td class="py-4 text-center"><input type="checkbox" checked class="w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500"></td>
                                            </tr>
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="py-4 px-2 font-bold text-gray-900">Akses forum diskusi</td>
                                                <td class="py-4 px-2 text-gray-500 text-xs">Akses forum diskusi</td>
                                                <td class="py-4 text-center"><input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500"></td>
                                                <td class="py-4 text-center"><input type="checkbox" checked class="w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500"></td>
                                            </tr>
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="py-4 px-2 font-bold text-gray-900">Akses modul belajar</td>
                                                <td class="py-4 px-2 text-gray-500 text-xs">Akses modul belajar</td>
                                                <td class="py-4 text-center"><input type="checkbox" checked class="w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500"></td>
                                                <td class="py-4 text-center"><input type="checkbox" checked class="w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500"></td>
                                            </tr>
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="py-4 px-2 font-bold text-gray-900">Akses sistem notifikasi</td>
                                                <td class="py-4 px-2 text-gray-500 text-xs">Akses sistem notifikasi</td>
                                                <td class="py-4 text-center"><input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500"></td>
                                                <td class="py-4 text-center"><input type="checkbox" checked class="w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="flex justify-end mt-6">
                                    <button type="button" class="px-6 py-2.5 text-white bg-purple-600 hover:bg-purple-700 rounded-xl font-medium text-sm shadow-sm transition" onclick="alert('Perubahan berhasil disimpan!')">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                            <p class="text-xs text-yellow-800 leading-relaxed">
                                <strong>Catatan:</strong> Jika admin mengubah centang fitur, maka semua user dengan paket tersebut akan mengikuti aturan akses terbaru secara otomatis.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                            <h2 class="text-base font-semibold text-gray-900 mb-4">Ringkasan Paket</h2>
                            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-xs">Total Paket</span>
                                    <span class="text-gray-900 font-bold text-sm">2</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 text-xs">Total Fitur</span>
                                    <span class="text-gray-900 font-bold text-sm">4</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-950 rounded-xl p-6 text-white shadow-sm">
                            <div class="text-xs text-gray-400 uppercase tracking-wider mb-2">Rekomendasi</div>
                            <h3 class="text-sm font-semibold mb-3">Kelola Akses Dengan Konsisten</h3>
                            <p class="text-xs text-gray-400 leading-relaxed mb-4">
                                Paket Free sebaiknya hanya berisi fitur dasar. Paket Premium dapat diberikan akses penuh seperti forum, live teaching, notifikasi, dan study planner.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
</html>