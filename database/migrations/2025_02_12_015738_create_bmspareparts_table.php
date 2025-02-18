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
        Schema::create('bmspareparts', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bmsparepart');
            $table->string('kode_sparepart');
            $table->text('nama_sparepart')->nullable();
            $table->string('kode_kategori')->index()->nullable();
            $table->string('kode_satuan')->index()->nullable();
            $table->string('harga');
            $table->integer('jumlah_stok');
            $table->text('keterangan')->nullable();
    
            // Relasi ke tabel categories

            
            $table->timestamps();
        });
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bmspareparts');
    }
};
