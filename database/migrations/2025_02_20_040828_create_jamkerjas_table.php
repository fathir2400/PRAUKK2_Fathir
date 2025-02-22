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
        // Create jam_kerja table
        Schema::create('jam_kerja', function (Blueprint $table) {
            $table->bigIncrements('id_jk'); // Primary key
            $table->enum('bagian', ['pagi', 'siang', 'malam']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();
        });

        // Create shifts table
        Schema::create('shift', function (Blueprint $table) {
            $table->id();
            $table->date('shift_date');
            
            // Foreign key to users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Foreign key to jam_kerja table
            $table->unsignedBigInteger('id_jk');
            $table->foreign('id_jk')->references('id_jk')->on('jam_kerja')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift');
        Schema::dropIfExists('jam_kerja');
    }
};
