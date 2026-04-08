<?php

use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Siswa routes
    Route::middleware('siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/buat', [AspirasiController::class, 'create'])->name('aspirasi.create');
        Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
        Route::get('/aspirasi/{aspirasi}', [AspirasiController::class, 'show'])->name('aspirasi.show');
        Route::get('/histori', [AspirasiController::class, 'histori'])->name('aspirasi.histori');

        Route::get('/semua-aspirasi', [KritikSaranController::class, 'semuaAspirasi'])->name('semua-aspirasi');

        Route::get('/kritik-saran', [KritikSaranController::class, 'index'])->name('kritik-saran.index');
        Route::get('/kritik-saran/buat', [KritikSaranController::class, 'create'])->name('kritik-saran.create');
        Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');
        Route::get('/kritik-saran/{kritikSaran}', [KritikSaranController::class, 'show'])->name('kritik-saran.show');
    });

    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/aspirasi', [AdminController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/{aspirasi}', [AdminController::class, 'show'])->name('aspirasi.show');
        Route::post('/aspirasi/{aspirasi}/response', [AdminController::class, 'storeResponse'])->name('aspirasi.response.store');

        Route::get('/kritik-saran', [AdminController::class, 'kritikSaran'])->name('kritik-saran.index');

        Route::resource('kategori', KategoriController::class);
    });

    // Home redirect based on role
    Route::get('/home', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.aspirasi.index');
        }

        return redirect()->route('siswa.aspirasi.index');
    })->name('home');
});

// Root redirect to login or home
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }

    return redirect()->route('login');
});
