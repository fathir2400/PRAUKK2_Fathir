<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('peminjaman_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjamen')->onDelete('cascade');
            $table->string('kode_alat');
            $table->integer('jumlah');
            $table->timestamps();

            // Foreign key ke tabel `alats`
            $table->foreign('kode_alat')->references('kode_alat')->on('alats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_detail');
        Schema::dropIfExists('peminjaman');
    }
};
