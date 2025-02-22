<?php

namespace App\Http\Controllers;

use App\Models\merk;
use Illuminate\Http\Request;

class merkController extends Controller
{
    public function index()
    {
        $merk = merk::paginate(10); // Menggunakan pagination agar lebih efisien
        return view('merk.index', compact('merk'));
    }

    /**
     * Menyimpan merk baru ke dalam database
     */
    public function store(Request $request)
    {
        merk::create([
            'kode_merk' => $request->kode_merk,
            'nama_merk' => $request->nama_merk, // Pastikan sesuai dengan database
           
        ]);

        return redirect()->route('merk.index')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Mengambil data merk untuk edit berdasarkan ID
     */
    public function edit($id)
    {
        $merk = merk::findOrFail($id);
        return response()->json($merk);
    }

    /**
     * Memperbarui data merk berdasarkan ID
     */
    public function update(Request $request, $id)
    {
        $merk = merk::findOrFail($id);

        $merk->update([
            'kode_merk' => $request->kode_merk,
            'nama_merk' => $request->nama_merk,
           
        ]);

        return redirect()->route('merk.index')->with('message', 'Data berhasil diperbarui!');
    }

    /**
     * Menghapus data merk berdasarkan ID
     */
    public function destroy($id)
    {
        merk::findOrFail($id)->delete();
        return redirect()->route('merk.index')->with('message', 'Data berhasil dihapus!');
    }

    /**
     * Mengambil merk berdasarkan ID untuk API atau kebutuhan lain
     */
    public function getmerk($id)
    {
        $merk = merk::findOrFail($id);
        return response()->json($merk);
    }

    /**
     * Menampilkan daftar merk dalam bentuk invoice
     */
    public function show()
    {
        $merk = merk::paginate(10);
        return view('merk.invoice', compact('merk'));
    }
}
