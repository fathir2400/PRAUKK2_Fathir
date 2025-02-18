<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    public function index(){
        $merk = Merk::get();
        return view('merk.index', compact('merk'));
       }
       public function create(){
        $merk = Merk::all();
       
        return view('merk.create',[
            'merk' => $merk,
            
        ]);
        
    }
    public function store(Request $request)
{
    // Validasi data yang dikirimkan oleh form
    $request->validate([
        'nama_merk' => 'required|string|max:255',
       
    ]);

    // Hitung jumlah data di tabel merk untuk menentukan nomor berikutnya
    $lastNumber = Merk::count('id_merk') + 1;

    // Format kode merk (misalnya: KAT001, KAT002, dst.)
    $kodemerk = 'MRK' . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);

    // Simpan data ke tabel merk
    Merk::create([
        'kode_merk' => $kodemerk,
        'nama_merk' => $request->nama_merk,
       
    ]);

    // Redirect ke halaman merk dengan pesan sukses
    return redirect()->route('merk.index')->with('success', 'merk berhasil ditambahkan!');
}
public function edit($id)
    {
        $merk = Merk::findOrFail($id);
        return view('merk.update', compact('merk'));
    }

    // Menyimpan perubahan merk (update)
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kode_merk' => 'required|string|max:255',
            'nama_merk' => 'required|string|max:255',
           
        ]);

        // Ambil data merk berdasarkan ID
        $merk = Merk::findOrFail($id);

        // Update data merk
        $merk->update([
            'kode_merk' => $request->kode_merk,
            'nama_merk' => $request->nama_merk,
           
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('merk.index')->with('success', 'merk berhasil diperbarui!');
    }

    // Menghapus merk
    public function destroy($id)
    {
        // Ambil data merk berdasarkan ID
        $merk = Merk::findOrFail($id);

        // Hapus merk
        $merk->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('merk.index')->with('success', 'merk berhasil dihapus!');
    }
    public function show(Request $request){
        $merk = Merk::get();      
        return view('merk.invoice',compact('merk'));
       }
}
