<?php

namespace App\Http\Controllers;

use App\Models\PaketUser;
use App\Models\Fitur;
use Illuminate\Http\Request;

class PaketUserController extends Controller
{
     public function index()
    {
        $paketUsers = PaketUser::with('fiturs')->get();

        return view('paket-user.index', compact('paketUsers'));
    }

    public function create()
    {
        $fiturs = Fitur::all();

        return view('paket-user.create', compact('fiturs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'deskripsi' => 'nullable',
            'fitur' => 'nullable|array',
        ]);

        $paketUser = PaketUser::create([
            'nama_paket' => $request->nama_paket,
            'deskripsi' => $request->deskripsi,
        ]);

        $paketUser->fiturs()->sync($request->fitur);

        return redirect()
            ->route('paket-user.index')
            ->with('success', 'Paket user berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paketUser = PaketUser::with('fiturs')->findOrFail($id);
        $fiturs = Fitur::all();

        return view('paket-user.edit', compact('paketUser', 'fiturs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required',
            'deskripsi' => 'nullable',
            'fitur' => 'nullable|array',
        ]);

        $paketUser = PaketUser::findOrFail($id);

        $paketUser->update([
            'nama_paket' => $request->nama_paket,
            'deskripsi' => $request->deskripsi,
        ]);

        $paketUser->fiturs()->sync($request->fitur);

        return redirect()
            ->route('paket-user.index')
            ->with('success', 'Paket user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $paketUser = PaketUser::findOrFail($id);
        $paketUser->delete();

        return redirect()
            ->route('paket-user.index')
            ->with('success', 'Paket user berhasil dihapus.');
    }
}
