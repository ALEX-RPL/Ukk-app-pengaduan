# Aplikasi Pengaduan Sarana Sekolah

## Dokumentasi Pengembangan

### 1. Analisis Kebutuhan

Aplikasi Pengaduan Sarana Sekolah dikembangkan untuk mendukung proses input dan output pengaduan sarana sekolah secara efektif dan efisien. Aplikasi ini memiliki dua halaman utama:

#### a. Halaman Form Aspirasi Siswa
Digunakan oleh siswa untuk menyampaikan pengaduan atau masukan terkait sarana dan prasarana sekolah.

**Fitur:**
- Membuat aspirasi/pengaduan baru
- Melihat daftar aspirasi yang telah dikirim
- Melihat status penyelesaian aspirasi
- Melihat histori dan umpan balik aspirasi

#### b. Halaman Umpan Balik Aspirasi (Admin)
Digunakan oleh admin untuk memberikan umpan balik dari aspirasi dan mengubah status penyelesaian.

**Fitur:**
- Melihat daftar keseluruhan aspirasi
- Filter aspirasi (per tanggal, per bulan, per siswa, per kategori)
- Memberikan umpan balik terhadap aspirasi
- Mengubah status penyelesaian (pending, diproses, selesai, ditolak)
- Melihat histori aspirasi

### 2. Desain Database (ERD)

#### Tabel Users
- `id` (bigint, primary key)
- `name` (string)
- `email` (string, unique)
- `password` (string)
- `role` (enum: 'siswa', 'admin')
- `timestamps`

#### Tabel Aspirasis
- `id` (bigint, primary key)
- `user_id` (bigint, foreign key to users)
- `kategori` (enum: 'fasilitas', 'kebersihan', 'keamanan', 'lainnya')
- `judul` (string)
- `konten` (text)
- `status` (enum: 'pending', 'diproses', 'selesai', 'ditolak')
- `timestamps`

#### Tabel Responses
- `id` (bigint, primary key)
- `aspirasi_id` (bigint, foreign key to aspirasis)
- `admin_id` (bigint, foreign key to users)
- `response_text` (text)
- `status_update` (enum: 'diproses', 'selesai', 'ditolak')
- `timestamps`

### 3. Implementasi Kode

#### Teknologi yang Digunakan
- **Backend**: Laravel 13, PHP 8.3
- **Frontend**: Tailwind CSS 4, Blade Templates
- **Database**: MySQL
- **Testing**: Pest PHP

#### Struktur Aplikasi
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminController.php
│   │   ├── AspirasiController.php
│   │   └── AuthController.php
│   ├── Middleware/
│   │   ├── EnsureUserIsAdmin.php
│   │   └── EnsureUserIsSiswa.php
│   └── Requests/
│       ├── StoreAspirasiRequest.php
│       └── StoreResponseRequest.php
├── Models/
│   ├── Aspirasi.php
│   ├── Response.php
│   └── User.php
resources/views/
├── layouts/
│   └── app.blade.php
├── auth/
│   └── login.blade.php
├── siswa/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── show.blade.php
│   └── histori.blade.php
└── admin/
    ├── index.blade.php
    └── show.blade.php
```

### 4. Pengujian

#### Akun Pengguna

**Admin:**
- Email: `admin@sekolah.com`
- Password: `admin123`

**Siswa:**
- Email: `ahmad@student.com`
- Password: `siswa123`

- Email: `siti@student.com`
- Password: `siswa123`

- Email: `budi@student.com`
- Password: `siswa123`

#### Cara Menjalankan Aplikasi

1. Pastikan XAMPP/LAMPP sudah berjalan
2. Jalankan perintah berikut di terminal:
   ```bash
   php artisan serve
   ```
3. Akses aplikasi di browser: `http://localhost:8000`

### 5. Fitur Aplikasi

#### Siswa
- ✅ Membuat aspirasi/pengaduan baru
- ✅ Melihat daftar aspirasi keseluruhan
- ✅ Melihat status penyelesaian
- ✅ Melihat histori aspirasi
- ✅ Melihat umpan balik aspirasi
- ✅ Melihat progres perbaikan

#### Admin
- ✅ Melihat daftar aspirasi keseluruhan
- ✅ Filter aspirasi (per tanggal, per bulan, per siswa, per kategori)
- ✅ Memberikan umpan balik aspirasi
- ✅ Mengubah status penyelesaian
- ✅ Melihat histori aspirasi

### 6. Metode Pengembangan

Aplikasi ini dikembangkan menggunakan metode **Waterfall Sederhana**:
1. **Analisis Kebutuhan**: Mengidentifikasi kebutuhan pengguna (siswa dan admin)
2. **Desain**: Membuat ERD dan diagram alur program
3. **Implementasi**: Menulis kode sesuai desain
4. **Pengujian**: Melakukan testing fitur-fitur aplikasi
5. **Dokumentasi**: Membuat dokumentasi penggunaan aplikasi

### 7. Keamanan

- Password di-hash menggunakan bcrypt
- Middleware otorisasi untuk setiap role (siswa/admin)
- Validasi input pada setiap form
- Protection terhadap CSRF attack

---

**Dibuat oleh**: Junior Assistant Programmer (Siswa Kelas XII)  
**Tahun**: 2026  
**Hak Cipta**: Kemendasmen SPK-3/4
