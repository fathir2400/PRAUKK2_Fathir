<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servis', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('kode_servis', 10)->unique(); // Kode servis unik
            $table->string('plat_nomor', 20); // Plat nomor kendaraan
            $table->string('nama_motor', 255); // Nama motor
            $table->string('kode_merk')->index(); // Kode brand, diindeks
            $table->text('deskripsi_masalah'); // Deskripsi masalah kendaraan
            $table->unsignedBigInteger('user_id')->index(); // ID pelanggan (relasi ke users)
            $table->unsignedBigInteger('petugas_id')->index(); // ID petugas (relasi ke users/petugas)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servis');
    }
};
