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
        Schema::create('kategori_laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->comment('Nama kategori laporan');
            $table->string('slug')->unique()->comment('Slug unik untuk kategori (contoh: fasilitas, kebersihan)');
            $table->string('ikon')->nullable()->comment('Ikon untuk kategori (opsional)');
            $table->text('deskripsi')->nullable();
            $table->string('warna')->default('blue')->comment('Warna untuk badge kategori');
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0)->comment('Urutan tampilan');
            $table->timestamps();

            $table->index(['is_active', 'urutan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_laporan');
    }
};
