<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    // 1. Menampilkan halaman daftar paket (Sesuai Mockup 4.5.7)
    public function index()
    {
        // Kita tambahkan data fitur paket agar bisa tampil di halaman blade nanti
        $pakets = [
            [
                'nama' => 'Akses Dasar (Gratis)',
                'harga' => 0,
                'fitur' => ['Akses Materi Video', 'Quiz Dasar', 'History Belajar']
            ],
            [
                'nama' => 'Intellecta Pro (Premium)',
                'harga' => 90000,
                'fitur' => ['Akses Materi Video & Quiz', 'Live Teaching', 'Forum Diskusi', 'Study Planner', 'Notifikasi Pengingat']
            ]
        ];

        return view('student.subscription', compact('pakets'));
    }

    // 2. Menampilkan halaman formulir pembayaran (Sesuai Mockup 4.5.10)
    public function checkout()
    {
        // Jika user ternyata sudah premium, langsung kembalikan ke halaman paket
        if (auth()->user()->isPremium()) {
            return redirect()->route('subscription.index')->with('success', 'Anda sudah berlangganan Paket Premium!');
        }
        
        return view('student.checkout');
    }

    // 3. Proses simulasi upgrade/pembayaran (Sesuai FR-12)
    public function upgrade(Request $request)
    {
        // Mengambil data user yang sedang login
        $user = auth()->user();
        
        // Mengubah status paket user di database menjadi premium
        $user->package = 'premium';
        $user->save();

        // Kembalikan ke dashboard dengan pesan sukses gembira
        return redirect()->route('dashboard')->with('success', '🎉 Selamat! Pembayaran berhasil. Akun Anda telah di-upgrade ke Paket Premium.');
    }
}