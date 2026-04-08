<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    // Constants untuk status_update
    const STATUS_DIPROSES = 'diproses';

    const STATUS_SELESAI = 'selesai';

    const STATUS_DITOLAK = 'ditolak';

    const STATUS_LIST = [
        self::STATUS_DIPROSES,
        self::STATUS_SELESAI,
        self::STATUS_DITOLAK,
    ];

    protected $fillable = [
        'aspirasi_id',
        'admin_id',
        'response_text',
        'status_update',
    ];

    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Scope untuk filter by status
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status_update', $status);
    }

    // Scope untuk filter by admin
    public function scopeByAdmin($query, int $adminId)
    {
        return $query->where('admin_id', $adminId);
    }

    // Static helper untuk mendapatkan status update options
    public static function getStatusUpdateOptions(): array
    {
        return [
            self::STATUS_DIPROSES => 'Diproses',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DITOLAK => 'Ditolak',
        ];
    }

    public function getStatusUpdateLabel(): string
    {
        return match ($this->status_update) {
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => 'Unknown',
        };
    }
}
