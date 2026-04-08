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
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nis_pelapor')->nullable()->comment('NIS pelapor saat pelaporan');
            $table->string('kelas_pelapor')->nullable()->comment('Kelas pelapor saat pelaporan');
            $table->enum('kategori', ['fasilitas', 'kebersihan', 'keamanan', 'lainnya']);
            $table->string('judul');
            $table->text('konten');
            $table->string('lokasi')->comment('Lokasi sarana yang diadukan');
            $table->json('gambar')->nullable()->comment('Array path gambar yang diupload');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('user_id');
            $table->index('status');
            $table->index('kategori');
            $table->index('created_at');
            $table->index(['user_id', 'status']); // Composite index
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};
