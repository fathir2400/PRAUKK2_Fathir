<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenis extends Model
{
    use HasFactory;
    protected $table = 'jenis';
    protected $primaryKey = 'id_jenis';
    protected $fillable = [
        'kode_jenis',
        'nama_jenis',
        

        
    ];
    public function Type(): HasMany{
        return $this->hasMany(Type::class, 'kode_jenis', 'kode_jenis');
    }
}
