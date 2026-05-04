<?php

namespace App\Http\Controllers;

use App\Models\PaketBerlangganan;
use Illuminate\Http\Request;

class PaketBerlanggananController extends Controller
{
    public function index()
    {
        $paket = PaketBerlangganan::latest()->get();

        return view('paket-berlangganan.index', compact('paket'));
    }

    public function create()
    {
        return view('paket-berlangganan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'harga' => 'required|numeric',
            'durasi_hari' => 'required|numeric',
            'deskripsi' => 'nullable',
            'status' => 'required',
        ]);

        PaketBerlangganan::create([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'durasi_hari' => $request->durasi_hari,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('paket-berlangganan.index')
            ->with('success', 'Paket berlangganan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paket = PaketBerlangganan::findOrFail($id);

        return view('paket-berlangganan.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required',
            'harga' => 'required|numeric',
            'durasi_hari' => 'required|numeric',
            'deskripsi' => 'nullable',
            'status' => 'required',
        ]);

        $paket = PaketBerlangganan::findOrFail($id);

        $paket->update([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'durasi_hari' => $request->durasi_hari,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('paket-berlangganan.index')
            ->with('success', 'Paket berlangganan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $paket = PaketBerlangganan::findOrFail($id);
        $paket->delete();

        return redirect()
            ->route('paket-berlangganan.index')
            ->with('success', 'Paket berlangganan berhasil dihapus.');
    }
}
