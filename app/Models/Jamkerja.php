<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamKerja extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'jam_kerja';

    // Primary Key
    protected $primaryKey = 'id_jk';

    // Timestamps
    public $timestamps = true;

    // Mass Assignable Fields
    protected $fillable = ['bagian', 'jam_mulai', 'jam_selesai'];

    /**
     * Relationship: JamKerja has many Shifts
     */
    public function shifts()
    {
        return $this->hasMany(Shift::class, 'id_jk', 'id_jk'); // Foreign key setup
    }
}
