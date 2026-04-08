<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Constants untuk role
    const ROLE_ADMIN = 'admin';

    const ROLE_SISWA = 'siswa';

    const ROLE_LIST = [
        self::ROLE_ADMIN,
        self::ROLE_SISWA,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nis',
        'kelas_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'admin_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function kritikSaran()
    {
        return $this->hasMany(KritikSaran::class);
    }

    // Scope untuk filter by role
    public function scopeByRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    // Static helper untuk mendapatkan role options
    public static function getRoleOptions(): array
    {
        return [
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_SISWA => 'Siswa',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isSiswa(): bool
    {
        return $this->role === self::ROLE_SISWA;
    }

    public function getKelasInfoAttribute(): string
    {
        if (! $this->kelas) {
            return '-';
        }

        return "{$this->kelas->tingkat} {$this->kelas->jurusan}";
    }

    public function getNisOrAttribute(): string
    {
        return $this->nis ?? '-';
    }

    public function getKelasLengkapAttribute(): string
    {
        return $this->kelas ? $this->kelas->nama_kelas : '-';
    }
}
