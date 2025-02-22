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
        Schema::create('servis_alat', function (Blueprint $table) {
            $table->string('kode_servis_alat', 10)->primary();
            $table->string('kode_servis', 10)->index();
            $table->string('kode_alat')->index();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servis_alat');
    }
};
