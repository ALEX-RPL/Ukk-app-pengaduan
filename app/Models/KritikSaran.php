<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;

    protected $table = 'kritik_saran';

    const TIPE_KRITIK = 'kritik';

    const TIPE_SARAN = 'saran';

    const TIPE_LIST = [
        self::TIPE_KRITIK,
        self::TIPE_SARAN,
    ];

    protected $fillable = [
        'user_id',
        'tipe',
        'judul',
        'pesan',
        'lokasi',
        'gambar',
    ];

    protected function casts(): array
    {
        return [
            'gambar' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByTipe($query, $tipe)
    {
        return $query->where('tipe', $tipe);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public static function getTipeOptions(): array
    {
        return [
            self::TIPE_KRITIK => 'Kritik',
            self::TIPE_SARAN => 'Saran',
        ];
    }

    public function getTipeLabel(): string
    {
        return match ($this->tipe) {
            'kritik' => 'Kritik',
            'saran' => 'Saran',
            default => 'Unknown',
        };
    }

    public function getTipeBadgeClass(): string
    {
        return match ($this->tipe) {
            'kritik' => 'bg-red-100 text-red-800',
            'saran' => 'bg-blue-100 text-blue-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getImages(): array
    {
        return $this->gambar ?? [];
    }

    public function hasImages(): bool
    {
        return ! empty($this->gambar) && count($this->gambar) > 0;
    }

    public function getImageUrls(): array
    {
        $images = $this->getImages();

        return array_map(function ($image) {
            return asset('storage/'.$image);
        }, $images);
    }

    public function getThumbnailUrl(): ?string
    {
        $images = $this->getImages();
        if (empty($images)) {
            return null;
        }

        return asset('storage/'.$images[0]);
    }
}
