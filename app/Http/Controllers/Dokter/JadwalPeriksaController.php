<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JadwalPeriksaController extends Controller
{
    private const HARI = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    public function index()
    {
        // Hanya jadwal milik dokter yang sedang login
        $jadwals = Auth::user()->jadwalPeriksas()->get();
        return view('dokter.jadwal-periksa.index', compact('jadwals'));
    }

    public function create()
    {
        return view('dokter.jadwal-periksa.create', ['hariList' => self::HARI]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari'        => ['required', Rule::in(self::HARI)],
            'jam_mulai'   => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
        ]);

        // id_dokter terisi otomatis lewat relasi; jadwal baru = tidak aktif
        Auth::user()->jadwalPeriksas()->create($validated + ['status' => false]);

        return redirect()->route('jadwal-periksa.index')
            ->with('success', 'Jadwal periksa berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $jadwal = Auth::user()->jadwalPeriksas()->findOrFail($id);

        return view('dokter.jadwal-periksa.edit', [
            'jadwal'   => $jadwal,
            'hariList' => self::HARI,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $jadwal = Auth::user()->jadwalPeriksas()->findOrFail($id);

        $validated = $request->validate([
            'hari'        => ['required', Rule::in(self::HARI)],
            'jam_mulai'   => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'status'      => ['required', 'boolean'],
        ]);

        // Hanya satu jadwal aktif per dokter
        if ($validated['status']) {
            Auth::user()->jadwalPeriksas()
                ->where('id', '!=', $jadwal->id)
                ->update(['status' => false]);
        }

        $jadwal->update($validated);

        return redirect()->route('jadwal-periksa.index')
            ->with('success', 'Jadwal periksa berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $jadwal = Auth::user()->jadwalPeriksas()->findOrFail($id);

        // daftar_poli memakai cascadeOnDelete: jangan hapus jadwal yang sudah dipakai pasien
        if ($jadwal->daftarPolis()->exists()) {
            return redirect()->route('jadwal-periksa.index')
                ->with('error', 'Jadwal tidak dapat dihapus karena sudah dipakai pasien untuk mendaftar.');
        }

        $jadwal->delete();

        return redirect()->route('jadwal-periksa.index')
            ->with('success', 'Jadwal periksa berhasil dihapus.');
    }
}