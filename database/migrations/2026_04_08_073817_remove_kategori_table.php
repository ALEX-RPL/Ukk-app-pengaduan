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
        // Remove kategori_id from kelas table
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });

        // Drop kategori table
        Schema::dropIfExists('kategori');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate kategori table
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->comment('Nama kategori/jurusan (contoh: TKJ, RPL, DPIB)');
            $table->string('kode')->unique()->comment('Kode unik kategori');
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });

        // Add kategori_id back to kelas table
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable()->constrained('kategori')->after('id');
            $table->index('kategori_id');
        });
    }
};
