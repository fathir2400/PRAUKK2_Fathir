<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JamKerja;

class JamKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data jam kerja dengan pagination (10 per halaman)
        $jamkerja = JamKerja::paginate(10);

        return view('jamkerja.index', compact('jamkerja'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'bagian' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Simpan data baru
        JamKerja::create([
            'bagian' => $request->bagian,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jamkerja.index')->with('success', 'Jam kerja berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'bagian' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Cari data yang akan diupdate
        $jamkerja = JamKerja::findOrFail($id);

        // Update data
        $jamkerja->update([
            'bagian' => $request->bagian,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jamkerja.index')->with('success', 'Jam kerja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data yang akan dihapus
        $jamkerja = JamKerja::findOrFail($id);

        // Hapus data
        $jamkerja->delete();

        return redirect()->route('jamkerja.index')->with('success', 'Jam kerja berhasil dihapus.');
    }

    /**
     * Bulk delete for multiple jam kerja.
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('selected', []);

        if (empty($ids)) {
            return redirect()->route('jamkerja.index')->with('error', 'Tidak ada data yang dipilih untuk dihapus.');
        }

        JamKerja::whereIn('id_jk', $ids)->delete();

        return redirect()->route('jamkerja.index')->with('success', 'Data terpilih berhasil dihapus.');
    }
    public function show()
    {
        $jamkerja = JamKerja::paginate(10);
        return view('jamkerja.invoice', compact('jamkerja'));
    }
}
