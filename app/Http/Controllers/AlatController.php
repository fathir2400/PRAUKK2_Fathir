<?php

namespace App\Http\Controllers;

use App\Models\Data_alat;
use App\Models\Satuan;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    // Display a listing of the alat
    public function index()
    {
        $alat = Data_alat::all(); // Retrieve all alat from the database
        $satuan = Satuan::all();
        return view('alat.index', compact('satuan','alat'));
    }

    // Show the form for creating a new alat
    public function create()
    {
       
        $alat = Data_alat::all(); // Retrieve all alat from the database
        $satuan = Satuan::all();
        return view('alat.create', compact( 'satuan','alat'));
    }

    // Store a newly created alat in storage
    public function store(Request $request)
    {
        dd($request->all());
        // Validasi request
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Pastikan format gambar benar
            'nama_alat' => 'required|string|max:255',
            'stok' => 'required|integer', // Disarankan stok menjadi integer, bukan string
            'kode_satuan' => 'required|exists:satuans,kode_satuan',
            'keterangan' => 'required|string|max:255',
        ]);
    
        // Generate kode alat baru
        $lastNumber = Data_alat::count() + 1;
        $kodeAlat = 'ALT' . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
    
        // Simpan gambar ke storage
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('alat', 'public'); // Simpan ke storage
            $validated['gambar'] = $path; // Masukkan path ke array validated untuk disimpan ke database
        }
    
        // Simpan data ke database
        Data_alat::create([
            'kode_alat' => $kodeAlat,
            'gambar' => $validated['gambar'],
            'nama_alat' => $validated['nama_alat'],
            'stok' => $validated['stok'],
            'kode_satuan' => $validated['kode_satuan'],
            'keterangan' => $validated['keterangan'],
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('alat.index')->with('success', 'Alat created successfully.');
    }
    
    

    // Show the form for editing the specified alat
    public function edit(Data_alat $alat)
    {
        return view('admin.alat.edit', compact('alat'));
    }

    // Update the specified alat in storage
    public function update(Request $request, Data_alat $alat)
    {
        $validated = $request->validate([
            'kode_alat' => 'required|string|max:255',
            'gambar' => 'required|string|max:255',
            'nama_alat' => 'required|string|max:255',
            'stok' => 'required|string|max:255',
            'kode_satuan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $alat->update($validated); // Update the alat data in the database

        return redirect()->route('alat.index')->with('success', 'Alat updated successfully.');
    }

    // Remove the specified alat from storage
    public function destroy(Data_alat $alat)
    {
        $alat->delete(); // Delete the alat from the database

        return redirect()->route('alat.index')->with('success', 'Alat deleted successfully.');
    }
}
