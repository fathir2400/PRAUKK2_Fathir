<?php
namespace App\Http\Controllers;


use App\Models\Sparepart;
use App\Models\kategori;
use App\Models\Satuan;
use App\Models\bmsparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SparepartController extends Controller
{
    // Menampilkan daftar sparepart
    public function index()
    {
        // Mengambil semua sparepart dengan relasi ke kategori dan satuan
        $spareparts = Sparepart::with(['kategori', 'satuan'])->get();
        return view('sparepart.index', [
            'sparepart' => $spareparts
        ]);
    }
    public function create()
    {
        
        // Mendapatkan kategori terakhir untuk menentukan kode kategori berikutnya
        $lastkategori = Sparepart::orderBy('id', 'desc')->first();
        $nextKode = $lastkategori ? intval(substr($lastkategori->kode_sparepart, 3)) + 1 : 1;  // Mulai dari 1 jika tidak ada kategori
        
        // Fetch the barang data
        $kategori = Kategori::all();
        $satuan = Satuan::all(); // Assuming Barang is the model
    
        // Pass both nextKode and barang to the view
        return view('sparepart.create', compact('nextKode', 'kategori','satuan'));
    }
    

    // Menyimpan sparepart baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sparepart' => 'required|string',
            'harga' => 'required|string',
            'jumlah_stok' => 'required|integer',
            'kode_kategori' => 'required|exists:kategoris,kode_kategori',
            'kode_satuan' => 'required|exists:satuans,kode_satuan',
            'keterangan' => 'nullable|string',
        ]);
        
        $latest = Sparepart::latest()->first();
        $lastKode = $latest ? $latest->kode_sparepart : null;
        $number = 1;

        if ($lastKode) {
            preg_match('/(\d+)/', $lastKode, $matches);
            $number = (int)$matches[0] + 1;
        }

        $validated['kode_sparepart'] = 'SPT' . str_pad($number, 3, '0', STR_PAD_LEFT);
        
        $sparepart = Sparepart::create($validated);
        
        bmsparepart::create([
            'kode_sparepart' => $sparepart->kode_sparepart,
            'nama_sparepart' => $sparepart->nama_sparepart,
            'harga' => $sparepart->harga,
            'jumlah_stok' => $sparepart->jumlah_stok,
            'kode_kategori' => $sparepart->kode_kategori,
            'kode_satuan' => $sparepart->kode_satuan,
            'keterangan' => 'Stok Ditambahkan ' . $sparepart->jumlah_stok,
        ]);

        return redirect()->route('sparepart.index')
            ->with('success', 'Sparepart berhasil dibuat dan disimpan di dua tabel!');
    }

    // Menampilkan sparepart berdasarkan ID

    public function edit($id)
    {
        // Mengambil data sparepart berdasarkan ID
        $sparepart = Sparepart::findOrFail($id);
    
        // Mengambil kategori dan satuan yang ada
        $kategori = kategori::all();
        $satuan = Satuan::all();
    
        // Mengambil kode sparepart berikutnya (bisa disesuaikan jika dibutuhkan)
        $nextKode = $sparepart->kode_sparepart; // Menggunakan kode yang ada, atau bisa menggunakan logika lain
    
        return view('sparepart.update', compact('sparepart', 'kategori', 'satuan', 'nextKode'));
    }
    
    // Mengupdate sparepart
    public function update(Request $request, $id)
    {
      
        $validated = $request->validate([
            'nama_sparepart' => 'required|string',
            'harga' => 'required|string',
            'jumlah_stok' => 'required|integer',
            'kode_kategori' => 'required|exists:kategoris,kode_kategori',
           'kode_satuan' => 'required|exists:satuans,kode_satuan',
            'keterangan' => 'nullable|string',
        ]);

        $sparepart = Sparepart::findOrFail($id);
        $oldStok = $sparepart->jumlah_stok;
        $sparepart->update($validated);

        $existingBms = bmsparepart::where('kode_sparepart', $sparepart->kode_sparepart)->first();

if ($existingBms) {
    // Update entri yang ditemukan di bmsparepart
    $existingBms->update([
        'nama_sparepart' => $sparepart->nama_sparepart,
        'harga' => $sparepart->harga,
        'jumlah_stok' => $sparepart->jumlah_stok,
        'kode_kategori' => $sparepart->kode_kategori,
        'kode_satuan' => $sparepart->kode_satuan,
        'keterangan' => 'Stok diperbarui dari ' . $oldStok . ' menjadi ' . $sparepart->jumlah_stok,
    ]);

}

        return redirect()->route('sparepart.index')
            ->with('success', 'Sparepart berhasil di update!');
    }
    // Menghapus sparepart
    public function destroy($id)
    {
        // Mencari sparepart berdasarkan ID
        $sparepart = Sparepart::findOrFail($id);
        
        // Menghapus sparepart
        $sparepart->delete();

        // Mengembalikan respons JSON dengan pesan sukses
        return redirect()->route('sparepart.index')
        ->with('success', 'Sparepart berhasil dihapus!');
    }
    public function show()
    {
        $sparepart = Sparepart::get();
        return view('sparepart.invoice', compact('sparepart'));
    }
    
}


