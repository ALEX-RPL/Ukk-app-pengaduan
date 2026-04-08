<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    // Constants untuk status dan kategori
    const STATUS_PENDING = 'pending';

    const STATUS_DIPROSES = 'diproses';

    const STATUS_SELESAI = 'selesai';

    const STATUS_DITOLAK = 'ditolak';

    const KATEGORI_FASILITAS = 'fasilitas';

    const KATEGORI_KEBERSIHAN = 'kebersihan';

    const KATEGORI_KEAMANAN = 'keamanan';

    const KATEGORI_LAINNYA = 'lainnya';

    // Array constants untuk validation
    const STATUS_LIST = [
        self::STATUS_PENDING,
        self::STATUS_DIPROSES,
        self::STATUS_SELESAI,
        self::STATUS_DITOLAK,
    ];

    const KATEGORI_LIST = [
        self::KATEGORI_FASILITAS,
        self::KATEGORI_KEBERSIHAN,
        self::KATEGORI_KEAMANAN,
        self::KATEGORI_LAINNYA,
    ];

    protected $fillable = [
        'user_id',
        'kategori',
        'judul',
        'konten',
        'lokasi',
        'gambar',
        'status',
        'nis_pelapor',
        'kelas_pelapor',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function latestResponse()
    {
        return $this->hasOne(Response::class)->latestOfMany();
    }

    public function kategoriModel()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'slug');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('kategori', $category);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    public function scopeByMonth($query, $year, $month)
    {
        return $query->whereYear('created_at', $year)
            ->whereMonth('created_at', $month);
    }

    // Scope untuk filter by user (siswa)
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Static helper function untuk mendapatkan status options
    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_DIPROSES => 'Diproses',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DITOLAK => 'Ditolak',
        ];
    }

    // Static helper function untuk mendapatkan kategori options
    public static function getKategoriOptions(): array
    {
        return [
            self::KATEGORI_FASILITAS => 'Fasilitas',
            self::KATEGORI_KEBERSIHAN => 'Kebersihan',
            self::KATEGORI_KEAMANAN => 'Keamanan',
            self::KATEGORI_LAINNYA => 'Lainnya',
        ];
    }

    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'diproses' => 'bg-blue-100 text-blue-800',
            'selesai' => 'bg-green-100 text-green-800',
            'ditolak' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusLabel(): string
    {
        return match ($this->status) {
            'pending' => 'Pending',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => 'Unknown',
        };
    }

    public function getCategoryLabel(): string
    {
        // Try to get from kategoriModel relationship first
        if ($this->relationLoaded('kategoriModel') && $this->kategoriModel) {
            return $this->kategoriModel->nama_kategori;
        }

        // Fallback to static mapping using the kategori attribute (string)
        return match ($this->getAttribute('kategori')) {
            'fasilitas' => 'Fasilitas',
            'kebersihan' => 'Kebersihan',
            'keamanan' => 'Keamanan',
            'lainnya' => 'Lainnya',
            default => $this->getAttribute('kategori') ?? 'Unknown',
        };
    }

    public function getCategoryBadgeClass(): string
    {
        // Try to get from kategoriModel relationship first
        if ($this->relationLoaded('kategoriModel') && $this->kategoriModel) {
            return $this->kategoriModel->getBadgeClass();
        }

        // Fallback to static mapping
        return $this->getStatusBadgeClass();
    }

    // Helper untuk mendapatkan array gambar
    public function getImages(): array
    {
        return $this->gambar ?? [];
    }

    // Helper untuk cek apakah memiliki gambar
    public function hasImages(): bool
    {
        return ! empty($this->gambar) && count($this->gambar) > 0;
    }

    // Helper untuk mendapatkan jumlah gambar
    public function getImagesCount(): int
    {
        return count($this->getImages());
    }

    // Helper untuk mendapatkan URL gambar pertama (thumbnail)
    public function getThumbnailUrl(): ?string
    {
        $images = $this->getImages();
        if (empty($images)) {
            return null;
        }

        return asset('storage/'.$images[0]);
    }

    // Helper untuk mendapatkan semua URL gambar
    public function getImageUrls(): array
    {
        $images = $this->getImages();

        return array_map(function ($image) {
            return asset('storage/'.$image);
        }, $images);
    }
}
