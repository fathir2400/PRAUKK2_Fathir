<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'kode_kategori',
        'nama',
        'keterangan',

        
    ];
    public function Sparepart(): HasMany{
        return $this->hasMany(Sparepart::class, 'kode_kategori', 'kode_kategori');
    }
    
}
