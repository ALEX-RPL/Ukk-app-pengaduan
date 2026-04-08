<?php

namespace Database\Seeders;

use App\Models\Aspirasi;
use App\Models\Response;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', User::ROLE_ADMIN)->first();
        $aspirasis = Aspirasi::all();

        // Create responses for some aspirasis
        $responseData = [
            Aspirasi::STATUS_DIPROSES => 'Terima kasih atas laporannya. Tim kami akan segera menindaklanjuti aspirasi Anda. Kami akan mengupdate progres secara berkala.',
            Aspirasi::STATUS_SELESAI => 'Alhamdulillah, aspirasi Anda telah ditindaklanjuti dan permasalahan telah diselesaikan. Terima kasih atas kesabarannya.',
            Aspirasi::STATUS_DITOLAK => 'Mohon maaf, aspirasi Anda tidak dapat ditindaklanjuti karena tidak sesuai dengan kebijakan sekolah. Silakan konsultasikan lebih lanjut ke bagian kesiswaan.',
        ];

        foreach ($aspirasis as $aspirasi) {
            if (in_array($aspirasi->status, Response::STATUS_LIST)) {
                Response::create([
                    'aspirasi_id' => $aspirasi->id,
                    'admin_id' => $admin->id,
                    'response_text' => $responseData[$aspirasi->status],
                    'status_update' => $aspirasi->status,
                    'created_at' => $aspirasi->created_at->addDays(rand(1, 3)),
                    'updated_at' => $aspirasi->created_at->addDays(rand(1, 3)),
                ]);
            }
        }
    }
}
