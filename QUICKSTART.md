# Quick Start Guide - Aplikasi Pengaduan Sarana Sekolah

## Cara Menjalankan Aplikasi

### 1. Start Development Server
```bash
cd /opt/lampp/htdocs/Ukk-app-pengaduan
php artisan serve
```

### 2. Akses Aplikasi di Browser
Buka browser dan akses: `http://localhost:8000`

### 3. Login dengan Akun yang Tersedia

#### Admin (Untuk Memberikan Umpan Balik)
- **Email**: `admin@sekolah.com`
- **Password**: `admin123`

#### Siswa (Untuk Membuat Aspirasi)
- **Email**: `ahmad@student.com`
- **Password**: `siswa123`

atau

- **Email**: `siti@student.com`
- **Password**: `siswa123`

atau

- **Email**: `budi@student.com`
- **Password**: `siswa123`

## Fitur Utama

### Halaman Siswa
1. **Daftar Aspirasi** - Lihat semua aspirasi yang telah dikirim
2. **Buat Aspirasi Baru** - Form untuk mengirim pengaduan baru
3. **Detail Aspirasi** - Lihat status dan umpan balik untuk setiap aspirasi
4. **Histori Aspirasi** - Lihat progres perbaikan aspirasi

### Halaman Admin
1. **Daftar Aspirasi** - Lihat semua aspirasi dari siswa
2. **Filter Aspirasi** - Filter berdasarkan:
   - Kategori (Fasilitas, Kebersihan, Keamanan, Lainnya)
   - Status (Pending, Diproses, Selesai, Ditolak)
   - Siswa
   - Tanggal
3. **Berikan Umpan Balik** - Respon aspirasi dengan update status
4. **Histori Umpan Balik** - Lihat semua respon yang telah diberikan

## Status Aspirasi
- **Pending** - Aspirasi baru belum diproses
- **Diproses** - Aspirasi sedang ditindaklanjuti
- **Selesai** - Aspirasi telah diselesaikan
- **Ditolak** - Aspirasi tidak dapat ditindaklanjuti

## Kategori Aspirasi
- **Fasilitas** - Kerusakan atau kekurangan fasilitas
- **Kebersihan** - Masalah kebersihan
- **Keamanan** - Masalah keamanan
- **Lainnya** - Lainnya

## Database sudah terisi dengan 6 data aspirasi sample untuk testing.
