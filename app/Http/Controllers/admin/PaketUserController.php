<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Fitur;
use Illuminate\Http\Request;

class PaketUserController extends Controller
{
    public function index()
    {
        $pakets = Paket::with('fiturs')->orderBy('id')->get();
        $fiturs = Fitur::orderBy('id')->get();

        return view('admin.paket-user.index', compact('pakets', 'fiturs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'akses' => ['nullable', 'array'],
            'akses.*' => ['nullable', 'array'],
            'akses.*.*' => ['exists:fiturs,id'],
        ]);

        $pakets = Paket::all();

        foreach ($pakets as $paket) {
            $fiturIds = $request->input('akses.' . $paket->id, []);
            $paket->fiturs()->sync($fiturIds);
        }

        return redirect()
            ->back()
            ->with('success', 'Pengaturan akses paket user berhasil diperbarui.');
    }
}