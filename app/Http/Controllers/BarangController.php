<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Perbaikan namespace Validator

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::get();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $barang = Barang::all();
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $ruangan = Ruangan::all();
        return view('barang.create', [
            'barang' => $barang,
            'kategori' => $kategori,
            'satuan' => $satuan,
            'ruangan' => $ruangan,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'nama' => 'required',
            'kode_kategori' => 'required',
            'kode_satuan' => 'required',
            'kode_ruangan' => 'required',
            'jumlah_barang' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Menyimpan data ke database
        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama' => $request->nama,
            'kode_kategori' => $request->kode_kategori,
            'kode_satuan' => $request->kode_satuan,
            'kode_ruangan' => $request->kode_ruangan,
            'jumlah_barang' => $request->jumlah_barang,
        ]);

        return redirect(url('/barang'))->with('success', 'Barang telah berhasil dibuat');
    }
    public function edit($kode_barang){
        $barang = Barang::find($kode_barang);
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $ruangan = Ruangan::all();
        return view('barang.update', compact('barang', 'kategori', 'satuan','ruangan'));
    }
    
    public function update(Request $request, $kode_barang){
        $data = barang::find($kode_barang);
    
        if (!$data) {
            return redirect('/barang')->with('error', 'barang tidak ditemukan');
        }
    
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'nama' => 'required',
            'kode_kategori' => 'required',
            'kode_satuan' => 'required',
            'kode_ruangan' => 'required',
            'jumlah_barang' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Memperbarui data
        $data->kode_barang = $request->kode_barang;
        $data->nama = $request->nama;
        $data->kode_kategori = $request->kode_kategori;
        $data->kode_satuan = $request->kode_satuan;
        $data->kode_ruangan = $request->kode_ruangan;
        $data->jumlah_barang = $request->jumlah_barang;
        $data->save();
    
        return redirect(url('/barang'))->with('success', 'barang telah berhasil diperbarui');
    }
    
    public function destroy($id)
    {
        // Ambil data barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Hapus barang
        $barang->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'barang berhasil dihapus!');
    }
    public function show(Request $request){
        $barang = Barang::get();      
        return view('barang.invoice',compact('barang'));
       }
}
