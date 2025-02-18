<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;
    protected $table = 'types';
    protected $primaryKey = 'id_type';
    protected $fillable = [
        'kode_jenis',
        'kode_merk',
        'nama_type',
        'tahun',

        
    ];
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'kode_jenis', 'kode_jenis');
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class, 'kode_merk', 'kode_merk'); 
    }
    
}

