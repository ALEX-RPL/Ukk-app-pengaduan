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
        // Create kelas table first
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas')->comment('Nama kelas (contoh: TKJ 1, RPL 1)');
            $table->string('tingkat')->comment('Tingkat kelas (X, XI, XII)');
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->index(['nama_kelas', 'tingkat']);
        });

        // Create users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nis')->nullable()->comment('NIS untuk siswa, null untuk admin');
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->comment('Kelas untuk siswa');
            $table->string('password');
            $table->enum('role', ['siswa', 'admin'])->default('siswa');
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('sessions');
    }
};
