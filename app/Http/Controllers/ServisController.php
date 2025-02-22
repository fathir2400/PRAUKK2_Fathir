<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralRequest;

use App\Models\servisSparepart;
use App\Models\servisAlat;
use App\Models\Alat;

use App\Models\Data_alat;
use App\Models\Merk;
use App\Models\Servis;
use App\Models\SparePart;
use App\Models\User;
use Illuminate\Http\Request;

class servisController extends Controller
{
    public function index()
    {
        // Menggunakan paginate untuk mendukung pagination
        $servis = Servis::with(['servisSparepart', 'servisAlat', 'petugas', 'pengguna'])->paginate(10); // 10 data per halaman
        $alat = Data_alat::all();
        $merk = Merk::all();
        $sparepart = SparePart::all();
        $pengguna = User::where('role', 'pengguna')->get();
        $petugas = User::where('role', 'petugas')->get();
    
        return view('servis.index', compact('servis', 'alat', 'merk', 'sparepart', 'pengguna', 'petugas'));
    }
    

    public function store(Request $request)
    {
        $servis = servis::create([
            'kode_servis' => $request->kode_servis,
            'plat_nomor' => $request->plat_nomor,
            'nama_motor' => $request->nama_motor,
            'kode_merk' => $request->kode_merk,
            'deskripsi_masalah' => $request->deskripsi_masalah,
            'user_id' => $request->user_id,
            'petugas_id' => $request->petugas_id,
        ]);

        // Simpan data sparepart ke pivot
        if ($request->sparepart) {
            foreach ($request->sparepart as $index => $kode_sparepart) {
                servisSparepart::create([
                    'kode_servis_sparepart' => $servis->kode_servis . '-SP' . ($index + 1),
                    'kode_servis' => $servis->kode_servis,
                    'kode_sparepart' => $kode_sparepart,
                ]);
            }
        }

        // Simpan data alat ke pivot
        if ($request->alat) {
            foreach ($request->alat as $index => $kode_alat) {
                servisAlat::create([
                    'kode_servis_alat' => $servis->kode_servis . '-AL' . ($index + 1),
                    'kode_servis' => $servis->kode_servis,
                    'kode_alat' => $kode_alat,
                ]);
            }
        }

        return redirect()->route('servis.index')->with('message', 'Data berhasil ditambahkan!');
    }

    public function edit($kode_servis)
    {
        // Pastikan relasi di-load dengan with()
        $servis = Servis::with(['servisSparepart', 'servisAlat', 'petugas', 'pengguna'])->find($kode_servis);
    
        // Cek apakah data servis ditemukan
        if (!$servis) {
            return response()->json(['error' => 'Servis tidak ditemukan'], 404);
        }
    
        // Debugging: Cek apakah relasi ter-load
        \Log::info('Servis Data:', $servis->toArray());
        \Log::info('ServisSparepart:', $servis->servisSparepart);
        \Log::info('ServisAlat:', $servis->servisAlat);
    
        return response()->json([
            'servis' => $servis,
            'selected_sparepart' => $servis->servisSparepart ? $servis->servisSparepart->pluck('kode_sparepart')->toArray() : [],
            'selected_alat' => $servis->servisAlat ? $servis->servisAlat->pluck('kode_alat')->toArray() : [],
        ]);
    }
    
        
    public function update(Request $request, $kode_servis)
    {
        $servis = servis::findOrFail($kode_servis);
        $servis->update([
            'plat_nomor' => $request->plat_nomor,
            'nama_motor' => $request->nama_motor,
            'kode_merk' => $request->kode_merk,
            'deskripsi_masalah' => $request->deskripsi_masalah,
            'user_id' => $request->user_id,
            'petugas_id' => $request->petugas_id,
        ]);

        // Hapus data lama
        servisSparepart::where('kode_servis', $kode_servis)->delete();
        servisAlat::where('kode_servis', $kode_servis)->delete();

        // Simpan data baru
        if ($request->sparepart) {
            foreach ($request->sparepart as $index => $kode_sparepart) {
                servisSparepart::create([
                    'kode_servis_sparepart' => $kode_servis . '-SP' . ($index + 1),
                    'kode_servis' => $kode_servis,
                    'kode_sparepart' => $kode_sparepart,
                ]);
            }
        }

        if ($request->alat) {
            foreach ($request->alat as $index => $kode_alat) {
                servisAlat::create([
                    'kode_servis_alat' => $kode_servis . '-AL' . ($index + 1),
                    'kode_servis' => $kode_servis,
                    'kode_alat' => $kode_alat,
                ]);
            }
        }

        return redirect()->route('servis.index')->with('message', 'Data berhasil diperbarui!');
    }

    public function destroy($kode_servis)
    {
        $servis = servis::findOrFail($kode_servis);
    
        // Hapus data terkait di tabel pivot
        servisSparepart::where('kode_servis', $kode_servis)->delete();
        servisAlat::where('kode_servis', $kode_servis)->delete();
    
        // Hapus data servis utama
        $servis->delete();
    
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
            public function riwayat()
        {
            $userId = auth()->id(); // Ambil ID user yang sedang login
            $serviss = servis::where('user_id', $userId)->with(['petugas', 'servisSpareparts.sparepart', 'servisAlat.alat'])->get();

            return view('servis.riwayat', compact('serviss'));
        }

}
