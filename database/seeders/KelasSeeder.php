<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasData = [
            // X (Kelas 10)
            ['DPIB 1', 'X', 'Kelas X DPIB 1'],
            ['SIJA 1', 'X', 'Kelas X SIJA 1'],
            ['RPL 1', 'X', 'Kelas X RPL 1'], ['RPL 2', 'X', 'Kelas X RPL 2'],
            ['DKV 1', 'X', 'Kelas X DKV 1'], ['DKV 2', 'X', 'Kelas X DKV 2'], ['DKV 3', 'X', 'Kelas X DKV 3'], ['DKV 4', 'X', 'Kelas X DKV 4'],
            ['TKR 1', 'X', 'Kelas X TKR 1'], ['TKR 2', 'X', 'Kelas X TKR 2'], ['TKR 3', 'X', 'Kelas X TKR 3'], ['TKR 4', 'X', 'Kelas X TKR 4'],
            ['TSM 1', 'X', 'Kelas X TSM 1'], ['TSM 2', 'X', 'Kelas X TSM 2'], ['TSM 3', 'X', 'Kelas X TSM 3'], ['TSM 4', 'X', 'Kelas X TSM 4'],
            ['TKJ 1', 'X', 'Kelas X TKJ 1'], ['TKJ 2', 'X', 'Kelas X TKJ 2'], ['TKJ 3', 'X', 'Kelas X TKJ 3'], ['TKJ 4', 'X', 'Kelas X TKJ 4'],
            ['Animasi 1', 'X', 'Kelas X Animasi 1'], ['Animasi 2', 'X', 'Kelas X Animasi 2'], ['Animasi 3', 'X', 'Kelas X Animasi 3'], ['Animasi 4', 'X', 'Kelas X Animasi 4'],
            ['LPKC 1', 'X', 'Kelas X LPKC 1'], ['LPKC 2', 'X', 'Kelas X LPKC 2'], ['LPKC 3', 'X', 'Kelas X LPKC 3'], ['LPKC 4', 'X', 'Kelas X LPKC 4'],

            // XI (Kelas 11)
            ['DPIB 1', 'XI', 'Kelas XI DPIB 1'],
            ['SIJA 1', 'XI', 'Kelas XI SIJA 1'],
            ['RPL 1', 'XI', 'Kelas XI RPL 1'], ['RPL 2', 'XI', 'Kelas XI RPL 2'],
            ['DKV 1', 'XI', 'Kelas XI DKV 1'], ['DKV 2', 'XI', 'Kelas XI DKV 2'], ['DKV 3', 'XI', 'Kelas XI DKV 3'], ['DKV 4', 'XI', 'Kelas XI DKV 4'],
            ['TKR 1', 'XI', 'Kelas XI TKR 1'], ['TKR 2', 'XI', 'Kelas XI TKR 2'], ['TKR 3', 'XI', 'Kelas XI TKR 3'], ['TKR 4', 'XI', 'Kelas XI TKR 4'],
            ['TSM 1', 'XI', 'Kelas XI TSM 1'], ['TSM 2', 'XI', 'Kelas XI TSM 2'], ['TSM 3', 'XI', 'Kelas XI TSM 3'], ['TSM 4', 'XI', 'Kelas XI TSM 4'],
            ['TKJ 1', 'XI', 'Kelas XI TKJ 1'], ['TKJ 2', 'XI', 'Kelas XI TKJ 2'], ['TKJ 3', 'XI', 'Kelas XI TKJ 3'], ['TKJ 4', 'XI', 'Kelas XI TKJ 4'],
            ['Animasi 1', 'XI', 'Kelas XI Animasi 1'], ['Animasi 2', 'XI', 'Kelas XI Animasi 2'], ['Animasi 3', 'XI', 'Kelas XI Animasi 3'], ['Animasi 4', 'XI', 'Kelas XI Animasi 4'],
            ['LPKC 1', 'XI', 'Kelas XI LPKC 1'], ['LPKC 2', 'XI', 'Kelas XI LPKC 2'], ['LPKC 3', 'XI', 'Kelas XI LPKC 3'], ['LPKC 4', 'XI', 'Kelas XI LPKC 4'],

            // XII (Kelas 12)
            ['DPIB 1', 'XII', 'Kelas XII DPIB 1'],
            ['SIJA 1', 'XII', 'Kelas XII SIJA 1'],
            ['RPL 1', 'XII', 'Kelas XII RPL 1'], ['RPL 2', 'XII', 'Kelas XII RPL 2'],
            ['DKV 1', 'XII', 'Kelas XII DKV 1'], ['DKV 2', 'XII', 'Kelas XII DKV 2'], ['DKV 3', 'XII', 'Kelas XII DKV 3'], ['DKV 4', 'XII', 'Kelas XII DKV 4'],
            ['TKR 1', 'XII', 'Kelas XII TKR 1'], ['TKR 2', 'XII', 'Kelas XII TKR 2'], ['TKR 3', 'XII', 'Kelas XII TKR 3'], ['TKR 4', 'XII', 'Kelas XII TKR 4'],
            ['TSM 1', 'XII', 'Kelas XII TSM 1'], ['TSM 2', 'XII', 'Kelas XII TSM 2'], ['TSM 3', 'XII', 'Kelas XII TSM 3'], ['TSM 4', 'XII', 'Kelas XII TSM 4'],
            ['TKJ 1', 'XII', 'Kelas XII TKJ 1'], ['TKJ 2', 'XII', 'Kelas XII TKJ 2'], ['TKJ 3', 'XII', 'Kelas XII TKJ 3'], ['TKJ 4', 'XII', 'Kelas XII TKJ 4'],
            ['Animasi 1', 'XII', 'Kelas XII Animasi 1'], ['Animasi 2', 'XII', 'Kelas XII Animasi 2'], ['Animasi 3', 'XII', 'Kelas XII Animasi 3'], ['Animasi 4', 'XII', 'Kelas XII Animasi 4'],
            ['LPKC 1', 'XII', 'Kelas XII LPKC 1'], ['LPKC 2', 'XII', 'Kelas XII LPKC 2'], ['LPKC 3', 'XII', 'Kelas XII LPKC 3'], ['LPKC 4', 'XII', 'Kelas XII LPKC 4'],
        ];

        foreach ($kelasData as $data) {
            Kelas::create([
                'nama_kelas' => $data[0],
                'tingkat' => $data[1],
                'deskripsi' => $data[2],
            ]);
        }
    }
}
