<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('student.subscription');
    }

    public function upgrade()
    {
        $user = auth()->user();
        $user->package = 'premium';
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Selamat! Akun Anda telah di-upgrade ke Paket Premium.');
    }
}
