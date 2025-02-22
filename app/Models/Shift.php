<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'shift_date',
        'id_jk', // Foreign key to jam_kerja
    ];

    // Casts for attribute transformation
    protected $casts = [
        'shift_date' => 'datetime:Y-m-d H:i:s', // Format shift_date
    ];

    /**
     * Relationship: Shift belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Shift belongs to JamKerja
     */
    public function jamKerja()
    {
        return $this->belongsTo(JamKerja::class, 'id_jk', 'id_jk');
    }

    /**
     * Relationship: Shift has many Absensi
     */
    
}
