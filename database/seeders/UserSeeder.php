<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('admin123'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Get kelas
        $tkjX1 = Kelas::where('nama_kelas', 'TKJ 1')->where('tingkat', 'X')->first();
        $rplX1 = Kelas::where('nama_kelas', 'RPL 1')->where('tingkat', 'X')->first();
        $dkvX1 = Kelas::where('nama_kelas', 'DKV 1')->where('tingkat', 'X')->first();

        // Create Students
        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@student.com',
            'password' => Hash::make('siswa123'),
            'role' => User::ROLE_SISWA,
            'nis' => '2024001',
            'kelas_id' => $tkjX1?->id,
        ]);

        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@student.com',
            'password' => Hash::make('siswa123'),
            'role' => User::ROLE_SISWA,
            'nis' => '2024002',
            'kelas_id' => $rplX1?->id,
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@student.com',
            'password' => Hash::make('siswa123'),
            'role' => User::ROLE_SISWA,
            'nis' => '2024003',
            'kelas_id' => $dkvX1?->id,
        ]);
    }
}
