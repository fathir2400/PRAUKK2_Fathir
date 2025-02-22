<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servis_sparepart', function (Blueprint $table) {
            $table->string('kode_servis_sparepart', 10)->primary();
            $table->string('kode_servis', 10)->index();
            $table->string('kode_sparepart', 6)->index();
           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servis_sparepart');
    }
};

