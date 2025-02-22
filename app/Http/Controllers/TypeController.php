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
    // Sebelumnya menggunakan get()
    // $type = Type::all();

    // Perbaiki dengan paginate()
    $type = Type::with(['jenis', 'merk'])->paginate(10); // 10 data per halaman

    $jenis = Jenis::all();
    $merk = Merk::all();

    return view('type.index', compact('type', 'jenis', 'merk'));
}

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_jenis' => 'required|exists:jenis,kode_jenis',
            'kode_merk' => 'required|exists:merks,kode_merk',
            'nama_type' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
        ]);
    
        Type::create($validated);
    
        return redirect()->route('type.index')->with('success', 'Type berhasil ditambahkan!');
    }
    
   
    
    // Update Function (Memperbarui Data Type)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_jenis' => 'required|exists:jenis,kode_jenis',
            'kode_merk' => 'required|exists:merks,kode_merk',
            'nama_type' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
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
    public function show()
    {
        $type = Type::paginate(10);
        return view('type.invoice', compact('type'));
    }
    

}
