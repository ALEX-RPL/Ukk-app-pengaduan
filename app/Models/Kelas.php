<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'deskripsi',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function getNamaLengkapAttribute(): string
    {
        return "Kelas {$this->tingkat} - {$this->nama_kelas}";
    }

    public function getDisplayAttribute(): string
    {
        $parts = explode(' ', $this->nama_kelas);
        $jurusan = $parts[0] ?? '';

        return "{$this->tingkat} {$jurusan}";
    }

    public function getTingkatLabelAttribute(): string
    {
        return "Kelas {$this->tingkat}";
    }

    public function getJurusanAttribute(): string
    {
        $parts = explode(' ', $this->nama_kelas);

        return $parts[0] ?? $this->nama_kelas;
    }
}
