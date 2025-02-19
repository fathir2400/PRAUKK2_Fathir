<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_detail';
    protected $fillable = ['peminjaman_id', 'kode_alat', 'jumlah'];

    // Relasi ke tabel `peminjaman`
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    // Relasi ke tabel `alats`
    public function alat()
    {
        return $this->belongsTo(Alat::class, 'kode_alat', 'kode_alat');
    }
    public function updateStok()
    {
        $alat = $this->alat;
        if($this->jumlah > 0){
            $alat->stok->$this->jumlah;
            $alat->save();
        }
    }
}
