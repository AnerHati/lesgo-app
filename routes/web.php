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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/daftar-siswa', function () {
    return Inertia::render('Auth/Student/Register');
});
Route::get('/lengkapi-profil', function () {
    return Inertia::render('Auth/Shared/CompleteProfile');
});
Route::get('/verifikasi', function () {
    return Inertia::render('Auth/Shared/VerifyAccount');
});
Route::get('/pilih-daftar', function () {
    return Inertia::render('Auth/RegisterSelection');
});
Route::get('/pilih-masuk', function () {
    return Inertia::render('Auth/LoginSelection');
});
Route::get('/masuk-siswa', function () {
    return Inertia::render('Auth/Student/Login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard-siswa', StudentDashboardController::class)->name('dashboard.siswa');
    Route::get('/dashboard-tutor', TutorDashboardController::class)->name('dashboard.tutor');
    Route::get('/dashboard-orang-tua', [ParentDashboardController::class, 'index'])->name('dashboard.orangtua');
});

Route::post('/study-classes/{studyClass}/materials', [MaterialController::class, 'store'])
    ->name('study-classes.materials.store');

    // Registration Steps
    Route::get('/lengkapi-profil', function () {
        return Inertia::render('Auth/Shared/CompleteProfile');
    })->name('register.step2');

    Route::post('/lengkapi-profil', [App\Http\Controllers\Auth\RegisterStepController::class, 'storeStep2'])
        ->name('register.step2.store');

    Route::get('/verifikasi', function () {
        return Inertia::render('Auth/Shared/VerifyAccount');
    })->name('register.step3');

    Route::post('/verifikasi', [App\Http\Controllers\Auth\RegisterStepController::class, 'storeStep3'])
        ->name('register.step3.store');

    // Dashboard routes
    Route::get('/dashboard-siswa', StudentDashboardController::class)->name('dashboard.siswa');
Route::get('/lengkapi-profil-tutor', function () {
    return Inertia::render('Auth/Tutor/RegisterStep1');
});
// Form Verifikasi Tutor (Langkah 3)
Route::get('/verifikasi-tutor', function () {
    return Inertia::render('Auth/Tutor/RegisterStep2');
});
Route::get('/login-tutor', function () {
    return Inertia::render('Auth/Tutor/Login');
});
Route::get('/daftar-orang-tua', function () {
    return Inertia::render('Auth/Parent/Register');
});

Route::get('/masuk-orang-tua', function () {
    return Inertia::render('Auth/Parent/Login');
});

Route::get('/lengkapi-profil-orang-tua', function () {
    return Inertia::render('Auth/Parent/RegisterStep1');
});