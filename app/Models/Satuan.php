<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Satuan extends Model
{
    use HasFactory;
    protected $table = 'satuans';
    protected $primaryKey = 'id_satuan';
    protected $fillable = [
        'kode_satuan',
        'nama',
        'keterangan',

        
    ];
    public function Sparepart(): HasMany{
        return $this->hasMany(Sparepart::class, 'kode_satuan', 'kode_satuan');
    }
}
