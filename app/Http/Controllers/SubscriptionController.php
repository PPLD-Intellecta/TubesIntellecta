<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('student.subscription');
    }

    public function checkout()
    {
        // If already premium, redirect back
        if (auth()->user()->isPremium()) {
            return redirect()->route('subscription.index')->with('success', 'Anda sudah berlangganan Paket Premium!');
        }
        return view('student.checkout');
    }

    public function upgrade(Request $request)
    {
        // Simulate payment validation (in real app, validate card here)
        $user = auth()->user();
        $user->package = 'premium';
        $user->save();

        return redirect()->route('dashboard')->with('success', '🎉 Selamat! Pembayaran berhasil. Akun Anda telah di-upgrade ke Paket Premium.');
    }
}
