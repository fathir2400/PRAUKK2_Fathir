<?php

namespace App\Http\Controllers;


use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Menampilkan daftar satuan dengan pagination
     */
    public function index()
    {
        $satuan = Satuan::paginate(10); // Menggunakan pagination agar lebih efisien
        return view('satuan.index', compact('satuan'));
    }

    /**
     * Menyimpan satuan baru ke dalam database
     */
    public function store(Request $request)
    {
        Satuan::create([
            'kode_satuan' => $request->kode_satuan,
            'nama' => $request->nama, // Pastikan sesuai dengan database
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('satuan.index')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Mengambil data satuan untuk edit berdasarkan ID
     */
    public function edit($id)
    {
        $satuan = Satuan::findOrFail($id);
        return response()->json($satuan);
    }

    /**
     * Memperbarui data satuan berdasarkan ID
     */
    public function update(Request $request, $id)
    {
        $satuan = Satuan::findOrFail($id);

        $satuan->update([
            'kode_satuan' => $request->kode_satuan,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('satuan.index')->with('message', 'Data berhasil diperbarui!');
    }

    /**
     * Menghapus data satuan berdasarkan ID
     */
    public function destroy($id)
    {
        Satuan::findOrFail($id)->delete();
        return redirect()->route('satuan.index')->with('message', 'Data berhasil dihapus!');
    }

    /**
     * Mengambil satuan berdasarkan ID untuk API atau kebutuhan lain
     */
    public function getSatuan($id)
    {
        $satuan = Satuan::findOrFail($id);
        return response()->json($satuan);
    }

    /**
     * Menampilkan daftar satuan dalam bentuk invoice
     */
    public function show()
    {
        $satuan = Satuan::paginate(10);
        return view('satuan.invoice', compact('satuan'));
    }
}
