<?php

use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TutorDashboardController;
use App\Http\Controllers\ParentDashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/daftar-siswa', function () {
    return Inertia::render('Auth/RegisterStudent');
});
Route::get('/lengkapi-profil', function () {
    return Inertia::render('Auth/CompleteProfile');
});
Route::get('/verifikasi', function () {
    return Inertia::render('Auth/VerifyAccount');
});
Route::get('/pilih-daftar', function () {
    return Inertia::render('Auth/RegisterSelection');
});
Route::get('/pilih-masuk', function () {
    return Inertia::render('Auth/LoginSelection');
});
Route::get('/masuk-siswa', function () {
    return Inertia::render('Auth/LoginStudent');
});

Route::get('/dashboard-siswa', StudentDashboardController::class)->name('dashboard.siswa');
Route::get('/dashboard-tutor', TutorDashboardController::class)->name('dashboard.tutor');
Route::get('/dashboard-orang-tua', [ParentDashboardController::class, 'index'])->name('dashboard.orangtua');

Route::post('/study-classes/{studyClass}/materials', [MaterialController::class, 'store'])
    ->name('study-classes.materials.store');

Route::get('/lengkapi-profil', function () {
    return Inertia::render('Auth/regisAkunSiswa1');
});
// Form Lengkapi Profil (Langkah 2)
Route::get('/lengkapi-profil', function () {
    return Inertia::render('Auth/regisAkunSiswa1');
});
// Form Verifikasi KTP & Ijazah (Langkah 3)
Route::get('/verifikasi', function () {
    return Inertia::render('Auth/regisAkunSiswa2');
});
// Halaman Pemilihan Masuk Akun
Route::get('/masuk-akun', function () {
    return Inertia::render('Auth/MasukAkun');
});
// Form Pendaftaran Tutor (Langkah 1)
Route::get('/daftar-tutor', function () {
    return Inertia::render('Auth/DaftarAkunTutor');
});
// Form Lengkapi Profil Tutor (Langkah 2)
Route::get('/lengkapi-profil-tutor', function () {
    return Inertia::render('Auth/RegisAkunTutor1');
});
// Form Verifikasi Tutor (Langkah 3)
Route::get('/verifikasi-tutor', function () {
    return Inertia::render('Auth/RegisAkunTutor2');
});
// Form Login Khusus Tutor
Route::get('/login-tutor', function () {
    return Inertia::render('Auth/LoginTutor');
});
// Form Pendaftaran Orang Tua (Langkah 1)
Route::get('/daftar-orang-tua', function () {
    return Inertia::render('Auth/DaftarAkunOrangTua');
});

// Form Login Khusus Orang Tua
Route::get('/masuk-orang-tua', function () {
    return Inertia::render('Auth/LoginOrangTua');
});

// Form Lengkapi Profil Orang Tua (Langkah 2)
Route::get('/lengkapi-profil-orang-tua', function () {
    return Inertia::render('Auth/RegisAkunOrangTua1');
});