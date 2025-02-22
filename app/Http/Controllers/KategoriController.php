<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = kategori::paginate(10); // Menggunakan pagination agar lebih efisien
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Menyimpan kategori baru ke dalam database
     */
    public function store(Request $request)
    {
        kategori::create([
            'kode_kategori' => $request->kode_kategori,
            'nama' => $request->nama, // Pastikan sesuai dengan database
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kategori.index')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Mengambil data kategori untuk edit berdasarkan ID
     */
    public function edit($id)
    {
        $kategori = kategori::findOrFail($id);
        return response()->json($kategori);
    }

    /**
     * Memperbarui data kategori berdasarkan ID
     */
    public function update(Request $request, $id)
    {
        $kategori = kategori::findOrFail($id);

        $kategori->update([
            'kode_kategori' => $request->kode_kategori,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kategori.index')->with('message', 'Data berhasil diperbarui!');
    }

    /**
     * Menghapus data kategori berdasarkan ID
     */
    public function destroy($id)
    {
        kategori::findOrFail($id)->delete();
        return redirect()->route('kategori.index')->with('message', 'Data berhasil dihapus!');
    }

    /**
     * Mengambil kategori berdasarkan ID untuk API atau kebutuhan lain
     */
    public function getkategori($id)
    {
        $kategori = kategori::findOrFail($id);
        return response()->json($kategori);
    }

    /**
     * Menampilkan daftar kategori dalam bentuk invoice
     */
    public function show()
    {
        $kategori = kategori::paginate(10);
        return   view('kategori.invoice', compact('kategori'));
    }
}
