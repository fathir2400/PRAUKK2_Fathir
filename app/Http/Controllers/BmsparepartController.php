<?php

namespace App\Http\Controllers;
use App\Models\bmsparepart;
use Illuminate\Http\Request;

class BmsparepartController extends Controller
{
    public function index()
    {
        // Mengambil semua sparepart dengan relasi ke kategori dan satuan
        $bmsparepart = bmsparepart::with(['kategori', 'satuan'])->get();
        return view('sparepart.bmindex', [
            'bmsparepart' => $bmsparepart
        ]);
    }
    public function destroy($id)
    {
        // Mencari sparepart berdasarkan ID
        $bmsparepart = bmsparepart::findOrFail($id);
        
        // Menghapus sparepart
        $bmsparepart->delete();

        // Mengembalikan respons JSON dengan pesan sukses
        return redirect()->route('sparepart.bmindex')
        ->with('success', 'bmparepart berhasil dihapus!');
    }
    public function show()
    {
        $bmsparepart = bmsparepart::get();
        return view('sparepart.laporan', [
            'bmsparepart' => $bmsparepart
        ]);
    }
}
