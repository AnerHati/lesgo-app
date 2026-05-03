<?php

use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TutorDashboardController;
use App\Http\Controllers\ParentDashboardController;
use App\Http\Controllers\Auth\RegisterStepController;
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

// ── Public pages (guest) ──────────────────────────────────────────────
Route::get('/pilih-daftar', function () {
    return Inertia::render('Auth/RegisterSelection');
});
Route::get('/pilih-masuk', function () {
    return Inertia::render('Auth/LoginSelection');
});

// Siswa
Route::get('/daftar-siswa', function () {
    return Inertia::render('Auth/Student/Register');
});
Route::get('/masuk-siswa', function () {
    return Inertia::render('Auth/Student/Login');
});

// Tutor
Route::get('/daftar-tutor', function () {
    return Inertia::render('Auth/Tutor/Register');
});
Route::get('/login-tutor', function () {
    return Inertia::render('Auth/Tutor/Login');
});

// Orang Tua
Route::get('/daftar-orang-tua', function () {
    return Inertia::render('Auth/Parent/Register');
});
Route::get('/masuk-orang-tua', function () {
    return Inertia::render('Auth/Parent/Login');
});

// ── Auth routes (Breeze) ──────────────────────────────────────────────
require __DIR__.'/auth.php';

// ── Authenticated routes ──────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Registration Steps (user is logged in but not fully registered yet)
    Route::get('/lengkapi-profil', function () {
        if (Auth::user()->registration_step >= 4) return redirect('/');
        return Inertia::render('Auth/Shared/CompleteProfile');
    })->name('register.step2');

    Route::post('/lengkapi-profil', [RegisterStepController::class, 'storeStep2'])
        ->name('register.step2.store');

    Route::get('/verifikasi', function () {
        if (Auth::user()->registration_step < 3) return redirect()->route('register.step2');
        if (Auth::user()->registration_step >= 4) return redirect('/');
        return Inertia::render('Auth/Shared/VerifyAccount');
    })->name('register.step3');

    Route::post('/verifikasi', [RegisterStepController::class, 'storeStep3'])
        ->name('register.step3.store');



    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard routes
    Route::middleware('role:siswa')->group(function () {
        Route::get('/dashboard-siswa', StudentDashboardController::class)->name('dashboard.siswa');
    });

    Route::middleware('role:tutor')->group(function () {
        Route::get('/dashboard-tutor', TutorDashboardController::class)->name('dashboard.tutor');
        Route::post('/study-classes/{studyClass}/materials', [MaterialController::class, 'store'])
            ->name('study-classes.materials.store');
    });

    Route::middleware('role:orangtua')->group(function () {
        Route::get('/dashboard-orang-tua', [ParentDashboardController::class, 'index'])->name('dashboard.orangtua');
    });
});
