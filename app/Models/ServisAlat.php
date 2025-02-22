<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServisAlat extends Model
{
    use HasFactory;

    protected $table = 'servis_alat';
    protected $primaryKey = 'kode_servis_alat';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kode_servis_alat',
        'kode_servis',
        'kode_alat',
    ];

    public function servis()
    {
        return $this->belongsTo(Servis::class, 'kode_servis', 'kode_servis');
    }

    public function alat()
    {
        return $this->belongsTo(Data_alat::class, 'kode_alat', 'kode_alat');
    }
}
