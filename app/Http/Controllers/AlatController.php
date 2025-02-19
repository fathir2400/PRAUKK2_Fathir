<?php

namespace App\Http\Controllers;

use App\Models\Data_alat;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    // Display a listing of the alat
    public function index()
    {
        $alat = Data_alat::all(); // Retrieve all alat from the database
       
        return view('alat.index', compact('alat'));
    }

    // Show the form for creating a new alat
    public function create()
    {
       
        $alat = Data_alat::all(); // Retrieve all alat from the database
       
        return view('alat.create', compact('alat'));
    }

    // Store a newly created alat in storage
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi request
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Pastikan format gambar benar
            'nama_alat' => 'required|string|max:255',
            'stok' => 'required|integer', // Disarankan stok menjadi integer, bukan string
           
            'keterangan' => 'required|string|max:255',
        ]);
        if ($request->hasFile('gambar')){
            $photoPath= $request->file('gambar')->store('gambar','public');
           } else {
            $photoPath = null;
           }
        // Generate kode alat baru
        $lastNumber = Data_alat::count() + 1;
        $kodeAlat = 'ALT' . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);

  
        // Simpan data ke database
        Data_alat::create([
            'kode_alat' => $kodeAlat,
            'gambar' => $photoPath,
            'nama_alat' => $validated['nama_alat'],
            'stok' => $validated['stok'],
            
            'keterangan' => $validated['keterangan'],
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('alat.index')->with('success', 'Alat created successfully.');
    }
    
    

    // Show the form for editing the specified alat
    public function edit($id_alat)
    {
        $alat = Data_alat::findOrFail($id_alat);
    // Ambil semua satuan

        return view('alat.update', compact('alat', ));
    }

    // Proses update alat
    public function update(Request $request, $id_alat)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'stok' => 'required|integer',
            'kode_satuan' => 'required|exists:satuans,kode_satuan',
           
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Ambil data alat dari database
        $alat = Data_alat::findOrFail($id_alat);
    
        // Jika ada gambar baru yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($alat->gambar) {
                Storage::disk('public')->delete($alat->gambar);
            }
    
            // Simpan gambar baru ke storage
            $photoPath = $request->file('gambar')->store('gambar', 'public');
            $validated['gambar'] = $photoPath; // Pastikan gambar baru disimpan
        }
    
        // Update data alat dengan data baru
        $alat->update($validated);
    
        return redirect()->route('alat.index')->with('success', 'Alat berhasil diperbarui.');
    }
    
    // Remove the specified alat from storage
    public function destroy(Data_alat $alat)
    {
        $alat->delete(); // Delete the alat from the database

        return redirect()->route('alat.index')->with('success', 'Alat deleted successfully.');
    }
}
