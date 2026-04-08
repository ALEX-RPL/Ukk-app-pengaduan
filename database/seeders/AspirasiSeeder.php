<?php

namespace Database\Seeders;

use App\Models\Aspirasi;
use App\Models\User;
use Illuminate\Database\Seeder;

class AspirasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', User::ROLE_SISWA)->get();

        // Sample aspirasi data
        $aspirasiData = [
            [
                'kategori' => Aspirasi::KATEGORI_FASILITAS,
                'judul' => 'AC Ruang Kelas XII IPA 1 Rusak',
                'konten' => "AC di ruang kelas XII IPA 1 sudah tidak berfungsi selama 2 minggu terakhir. Kondisi ini membuat siswa merasa kepanasan dan tidak nyaman saat proses belajar mengajar berlangsung.\n\nMohon segera diperbaiki atau diganti dengan unit yang baru.",
                'lokasi' => 'Ruang Kelas XII IPA 1, Gedung A',
                'status' => Aspirasi::STATUS_PENDING,
            ],
            [
                'kategori' => Aspirasi::KATEGORI_KEBERSIHAN,
                'judul' => 'Toilet Siswa Tidak Bersih',
                'konten' => "Toilet untuk siswa di gedung A sangat kotor dan bau. Beberapa kloset rusak dan tidak ada air di beberapa kloset.\n\nSemoga segera dibersihkan agar nyaman digunakan.",
                'lokasi' => 'Toilet Siswa Gedung A Lantai 1',
                'status' => Aspirasi::STATUS_DIPROSES,
            ],
            [
                'kategori' => Aspirasi::KATEGORI_FASILITAS,
                'judul' => 'Proyektor Ruang Multimedia Bermasalah',
                'konten' => "Proyektor di ruang multimedia sering mati tiba-tiba dan gambarnya tidak jelas. Hal ini menghambat proses pembelajaran yang menggunakan media elektronik.\n\nMohon dicek dan diperbaiki.",
                'lokasi' => 'Ruang Multimedia, Gedung B',
                'status' => Aspirasi::STATUS_SELESAI,
            ],
            [
                'kategori' => Aspirasi::KATEGORI_KEAMANAN,
                'judul' => 'Pagar Sekolah Bagian Belakang Bolong',
                'konten' => "Terdapat bagian pagar sekolah di belakang yang sudah bolong dan rusak. Hal ini dikhawatirkan memungkinkan orang yang tidak berkepentingan masuk ke area sekolah.\n\nMohon segera diperbaiki untuk keamanan bersama.",
                'lokasi' => 'Pagar Belakang Sekolah',
                'status' => Aspirasi::STATUS_PENDING,
            ],
            [
                'kategori' => Aspirasi::KATEGORI_LAINNYA,
                'judul' => 'Perpustakaan Kekurangan Buku Referensi',
                'konten' => "Koleksi buku perpustakaan terutama buku referensi untuk persiapan ujian nasional masih sangat minim. Mohon ditambah koleksi buku-buku terbaru untuk mendukung persiapan siswa.\n\nTerima kasih.",
                'lokasi' => 'Perpustakaan Sekolah',
                'status' => Aspirasi::STATUS_DIPROSES,
            ],
            [
                'kategori' => Aspirasi::KATEGORI_KEBERSIHAN,
                'judul' => 'Tempat Sampah Gedung B Kurang',
                'konten' => "Tempat sampah di Gedung B sangat kurang sehingga banyak siswa yang membuang sampah sembarangan. Mohon ditambah tempat sampah di setiap lantai.\n\nAgar lingkungan sekolah tetap bersih dan sehat.",
                'lokasi' => 'Gedung B',
                'status' => Aspirasi::STATUS_PENDING,
            ],
        ];

        foreach ($aspirasiData as $index => $data) {
            $user = $students[$index % $students->count()];

            Aspirasi::create([
                'user_id' => $user->id,
                'kategori' => $data['kategori'],
                'judul' => $data['judul'],
                'konten' => $data['konten'],
                'lokasi' => $data['lokasi'],
                'status' => $data['status'],
                'nis_pelapor' => $user->nis,
                'kelas_pelapor' => $user->kelas ? $user->kelas->nama_kelas : null,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 5)),
            ]);
        }
    }
}
