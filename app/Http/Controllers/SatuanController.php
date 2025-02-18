<?php

namespace App\Http\Controllers;

use App\Models\satuan;
use Illuminate\Http\Request;

class satuanController extends Controller
{
    public function index(){
        $satuan = satuan::get();
        return view('satuan.index', compact('satuan'));
       }
       public function create(){
        $satuan = satuan::all();
       
        return view('satuan.create',[
            'satuan' => $satuan,
            
        ]);
        
    }
    public function store(Request $request)
{
    // Validasi data yang dikirimkan oleh form
    $request->validate([
        'nama' => 'required|string|max:255',
        'keterangan' => 'nullable|string|max:255',
    ]);

    // Hitung jumlah data di tabel satuan untuk menentukan nomor berikutnya
    $lastNumber = satuan::count('id_satuan') + 1;

    // Format kode satuan (misalnya: KAT001, KAT002, dst.)
    $kodesatuan = 'SAT' . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);

    // Simpan data ke tabel satuan
    satuan::create([
        'kode_satuan' => $kodesatuan,
        'nama' => $request->nama,
        'keterangan' => $request->keterangan,
    ]);

    // Redirect ke halaman satuan dengan pesan sukses
    return redirect()->route('satuan.index')->with('success', 'satuan berhasil ditambahkan!');
}
public function edit($id)
    {
        $satuan = satuan::findOrFail($id);
        return view('satuan.update', compact('satuan'));
    }

    // Menyimpan perubahan satuan (update)
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kode_satuan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Ambil data satuan berdasarkan ID
        $satuan = satuan::findOrFail($id);

        // Update data satuan
        $satuan->update([
            'kode_satuan' => $request->kode_satuan,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('satuan.index')->with('success', 'satuan berhasil diperbarui!');
    }

    // Menghapus satuan
    public function destroy($id)
    {
        // Ambil data satuan berdasarkan ID
        $satuan = satuan::findOrFail($id);

        // Hapus satuan
        $satuan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('satuan.index')->with('success', 'satuan berhasil dihapus!');
    }
    public function show(Request $request){
        $satuan = satuan::get();      
        return view('satuan.invoice',compact('satuan'));
       }
}
