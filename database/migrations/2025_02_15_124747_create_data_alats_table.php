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
        Schema::create('data_alat', function (Blueprint $table) {
            $table->id('id_alat');
            $table->string('kode_alat');
            $table->string('gambar');
            $table->string('nama_alat');
            $table->string('stok');
            $table->string('kode_satuan');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_alats');
    }
};
