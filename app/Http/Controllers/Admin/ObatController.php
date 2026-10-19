<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::orderBy('nama_obat')->get();
        return view('admin.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => ['required', 'string', 'max:255'],
            'kemasan'   => ['required', 'string', 'max:35'],
            'harga'     => ['required', 'integer', 'min:0'],
        ]);

        Obat::create($validated);

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, string $id)
    {
        $obat = Obat::findOrFail($id);

        $validated = $request->validate([
            'nama_obat' => ['required', 'string', 'max:255'],
            'kemasan'   => ['required', 'string', 'max:35'],
            'harga'     => ['required', 'integer', 'min:0'],
        ]);

        $obat->update($validated);

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);

        // Tabel detail_periksa memakai cascadeOnDelete. Tanpa pengecekan ini,
        // menghapus obat yang pernah diresepkan akan ikut menghapus riwayat periksa.
        if ($obat->detailPeriksas()->exists()) {
            return redirect()->route('obat.index')
                ->with('error', 'Obat tidak dapat dihapus karena sudah digunakan pada data pemeriksaan.');
        }

        $obat->delete();

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil dihapus.');
    }
}