<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_alat extends Model
{
    use HasFactory;
    protected $table = 'data_alat';
    protected $primaryKey = 'id_alat';
    protected $fillable = [
        'kode_alat',
        'gambar',
        'nama_alat',
        'stok',
        'kode_satuan',
        'keterangan',

        
    ];
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'kode_satuan', 'kode_satuan');
    }
}
