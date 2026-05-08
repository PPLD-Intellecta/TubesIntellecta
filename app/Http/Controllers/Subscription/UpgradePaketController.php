<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class UpgradePaketController extends Controller
{
    public function upgradeToPremium(Request $request)
    {
        $premium = Paket::where('nama', 'Premium')->firstOrFail();

        $request->user()->update([
            'paket_id' => $premium->id,
        ]);

        return redirect('/student/dashboard')
            ->with('success', 'Selamat! Paket kamu berhasil berubah menjadi Premium.');
    }

    public function downgradeToFree(Request $request)
    {
        $free = Paket::where('nama', 'Free')->firstOrFail();

        $request->user()->update([
            'paket_id' => $free->id,
        ]);

        return redirect('/student/dashboard')
            ->with('success', 'Paket kamu berhasil dikembalikan menjadi Free.');
    }
}