<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Servis extends Model
{
    use HasFactory;

    protected $table = 'servis';
    protected $primaryKey = 'kode_servis';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kode_servis',
        'plat_nomor',
        'nama_motor',
        'kode_merk',
        'deskripsi_masalah',
        'user_id',
        'petugas_id',
    ];

    // Relasi ke User (Pengguna)
    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->where('role', 'pengguna');
    }

    // Relasi ke User (Petugas)
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id')->where('role', 'petugas');
    }

    // Relasi ke Brand
    public function merk()
    {
        return $this->belongsTo(Merk::class, 'kode_brand', 'kode_brand');
    }

    // Relasi ke Sparepart melalui pivot servis_sparepart
    public function servisSparepart()
    {
        return $this->hasMany(servisSparepart::class, 'kode_servis', 'kode_servis');
    }
    
    public function servisAlat()
    {
        return $this->hasMany(servisAlat::class, 'kode_servis', 'kode_servis');
    }
}
