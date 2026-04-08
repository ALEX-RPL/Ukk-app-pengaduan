<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Fasilitas',
                'slug' => 'fasilitas',
                'ikon' => '🏫',
                'deskripsi' => 'Laporan terkait fasilitas sekolah yang rusak, kurang memadai, atau perlu perbaikan',
                'warna' => 'blue',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Kebersihan',
                'slug' => 'kebersihan',
                'ikon' => '🧹',
                'deskripsi' => 'Laporan terkait kebersihan lingkungan sekolah, toilet, ruang kelas, dan area lainnya',
                'warna' => 'green',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Keamanan',
                'slug' => 'keamanan',
                'ikon' => '🔒',
                'deskripsi' => 'Laporan terkait keamanan dan keselamatan di lingkungan sekolah',
                'warna' => 'red',
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Lainnya',
                'slug' => 'lainnya',
                'ikon' => '📝',
                'deskripsi' => 'Laporan lain yang tidak termasuk dalam kategori di atas',
                'warna' => 'yellow',
                'urutan' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Kategori::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
