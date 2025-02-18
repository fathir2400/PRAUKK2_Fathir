<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Merk;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        // Mengambil semua sparepart dengan relasi ke kategori dan satuan
        $type = Type::with(['jenis', 'merk'])->get();
        return view('type.index', [
            'type' => $type
        ]);
    }
    public function create()
    {
        $type = Type::all();
        $jenis = Jenis::all();
        $merk = Merk::all();
       
      
        return view('type.create', [
            'type' => $type,
            'jenis' => $jenis,
            'merk' => $merk,
            
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_jenis' => 'required|exists:jenis,kode_jenis',
            'kode_merk' => 'required|exists:merks,kode_merk',
            'nama_type' => 'required|string',
            'tahun' => 'required|integer',
        ]);

        Type::create($validated);

        return redirect()->route('type.index')->with('success', 'Type berhasil ditambahkan!');
    }
    public function edit($id)
    {
        // Ambil data type berdasarkan ID
        $type = Type::findOrFail($id);
        
        // Ambil data jenis dan merk untuk dropdown
        $jenis = Jenis::all();
        $merk = Merk::all();
    
        return view('type.update', compact('type', 'jenis', 'merk'));
    }
    
    // Update Function (Memperbarui Data Type)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_jenis' => 'required|exists:jenis,kode_jenis',
            'kode_merk' => 'required|exists:merks,kode_merk',
            'nama_type' => 'required|string',
            'tahun' => 'required|integer',
        ]);

        $type = Type::findOrFail($id);
        $type->update($validated);

        return redirect()->route('type.index')->with('success', 'Type berhasil diperbarui!');
    }
    public function destroy($id)
    {
        // Mencari type berdasarkan ID
        $type = Type::findOrFail($id);
        
        // Menghapus type
        $type->delete();

        // Mengembalikan respons JSON dengan pesan sukses
        return redirect()->route('type.index')
        ->with('success', 'type berhasil dihapus!');
    }

}
