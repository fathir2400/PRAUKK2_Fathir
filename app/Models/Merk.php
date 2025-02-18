<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merk extends Model
{
    use HasFactory;
    protected $table = 'merks';
    protected $primaryKey = 'id_merk';
    protected $fillable = [
        'kode_merk',
        'nama_merk',
        

        
    ];
    public function Type(): HasMany{
        return $this->hasMany(Type::class, 'kode_merk', 'kode_merk');
    }
}
