<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServisSparepart extends Model
{
    use HasFactory;

    protected $table = 'servis_sparepart';
    protected $primaryKey = 'kode_servis_sparepart';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kode_servis_sparepart',
        'kode_servis',
        'kode_sparepart',
    ];

    public function servis()
    {
        return $this->belongsTo(Servis::class, 'kode_servis', 'kode_servis');
    }

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'kode_sparepart', 'kode_sparepart');
    }
}
