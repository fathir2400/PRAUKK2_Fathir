<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bmsparepart extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_bmsparepart',
        'kode_sparepart', 
        'nama_sparepart',
        'harga', 
        'jumlah_stok', 
        'keterangan', 
        'kode_kategori', 
        'kode_satuan',
    ];

    protected static function booted()
    {
        // Event saat record baru akan dibuat
        static::creating(function ($bmsparepart) {
            // Ambil sparepart terbaru untuk mendapatkan kode terakhir
            $latest = self::latest()->first(); 
            $lastKode = $latest ? $latest->kode_sparepart : null;
            $number = 1; // default number jika tidak ada sparepart

            if ($lastKode) {
                // Mengambil nomor terakhir dari kode_sparepart
                preg_match('/(\d+)/', $lastKode, $matches);
                $number = (int)$matches[0] + 1; // Tambah 1 untuk nomor berikutnya
            }

            // Format kode_sparepart: SP-001, SP-002, dst.
            $bmsparepart->kode_bmsparepart = 'BM' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    // Relasi ke tabel categories
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kode_kategori', 'kode_kategori');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'kode_satuan', 'kode_satuan'); 
    }
}
