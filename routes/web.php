<?php

use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TutorDashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParentDashboardController;
use App\Http\Controllers\Auth\RegisterStepController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $activeRole = $user->active_role;

        if ($activeRole) {
            $pivot = $user->getRolePivot($activeRole);
            if ($pivot && $pivot->registration_step >= 4) {
                return redirect('/');
            }
            
        }
       

        return Inertia::render('Auth/Shared/CompleteProfile');
    })->name('register.step2');

    Route::post('/lengkapi-profil', [RegisterStepController::class, 'storeStep2'])
        ->name('register.step2.store');

    Route::get('/verifikasi', function () {
        $user = Auth::user();
        $activeRole = $user->active_role;

        if ($activeRole) {
            $pivot = $user->getRolePivot($activeRole);
            if ($pivot) {
                if ($pivot->registration_step < 3) {
                    return redirect()->route('register.step2');
                }
                if ($pivot->registration_step >= 4) {
                    return redirect('/');
                }
            }
        }

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
        Route::post('/booking-tutor', [StudentDashboardController::class, 'storeBooking'])->name('booking.tutor');
        Route::get('/api/tutors', [\App\Http\Controllers\Api\TutorController::class, 'index']);

    });

    Route::middleware('role:tutor')->group(function () {
        Route::get('/dashboard-tutor', [TutorDashboardController::class, 'index'])->name('dashboard.tutor');
        
        // Ketersediaan Jadwal Tutor
        Route::get('/tutor/ketersediaan', [\App\Http\Controllers\TutorAvailabilityController::class, 'index'])->name('tutor.availability.index');
        Route::post('/tutor/ketersediaan', [\App\Http\Controllers\TutorAvailabilityController::class, 'store'])->name('tutor.availability.store');
        Route::get('/api/tutor/{tutorId}/availabilities', [\App\Http\Controllers\TutorAvailabilityController::class, 'getByTutor']);

        // Terima / Tolak Pesanan
        Route::post('/tutor/booking/{id}/accept', [TutorDashboardController::class, 'acceptBooking'])->name('tutor.booking.accept');
        Route::post('/tutor/booking/{id}/reject', [TutorDashboardController::class, 'rejectBooking'])->name('tutor.booking.reject');
        
        // CRUD Tutor
        Route::post('/tutor/jadwal', [TutorDashboardController::class, 'storeSchedule'])->name('tutor.jadwal.store');
        Route::post('/tutor/kelas/{studyClass}/materi', [TutorDashboardController::class, 'storeMaterial'])->name('tutor.materi.store');
        Route::post('/tutor/kelas/{studyClass}/tugas', [TutorDashboardController::class, 'storeTask'])->name('tutor.tugas.store');
        Route::post('/tutor/kelas/{studyClass}/catatan', [TutorDashboardController::class, 'storeNote'])->name('tutor.catatan.store');

        Route::post('/study-classes/{studyClass}/materials', [MaterialController::class, 'store'])
            ->name('study-classes.materials.store');
    });

    Route::middleware('role:orangtua')->group(function () {
        Route::get('/dashboard-orang-tua', [ParentDashboardController::class, 'index'])->name('dashboard.orangtua');
    });

    // ── Switch Role ──────────────────────────────────────────────────
    Route::post('/switch-role', function (\Illuminate\Http\Request $request) {
        $request->validate(['role' => 'required|string|in:siswa,tutor,orangtua']);

        $user = Auth::user();
        $newRole = $request->role;

        if (!$user->hasRole($newRole)) {
            return back()->withErrors(['role' => 'Anda tidak memiliki role tersebut.']);
        }

        $user->switchRole($newRole);

        return match ($newRole) {
            'tutor' => redirect()->route('dashboard.tutor'),
            'orangtua' => redirect()->route('dashboard.orangtua'),
            default => redirect()->route('dashboard.siswa'),
        };
    })->name('switch.role');

    // ── Chat API (hanya siswa & tutor yang boleh akses) ──────────────────
    Route::middleware('role:siswa,tutor')->group(function () {
        Route::get('/api/chat/contacts', [MessageController::class, 'getContacts']);
        Route::get('/api/chat/messages/{contactId}', [MessageController::class, 'fetchMessages']);
        Route::post('/api/chat/messages', [MessageController::class, 'sendMessage'])->middleware('throttle:60,1');
    });

    Route::get('/api/reviews/tutor/{tutorId}', [\App\Http\Controllers\ReviewController::class, 'getTutorReviews']);
    Route::post('/api/attachments', [\App\Http\Controllers\AttachmentController::class, 'upload'])->middleware('throttle:30,1');
    Route::get('/api/attachments/{id}/download', [\App\Http\Controllers\AttachmentController::class, 'download'])->name('attachments.download');
    Route::delete('/api/attachments/{id}', [\App\Http\Controllers\AttachmentController::class, 'delete']);

// ── API Notifikasi ────────────────────────────────────────
Route::get('/api/notifications', [\App\Http\Controllers\NotificationController::class, 'index']);
Route::get('/api/notifications/unread-count', [\App\Http\Controllers\NotificationController::class, 'unreadCount']);
Route::post('/api/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead']);
Route::post('/api/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead']);



// ── API khusus Siswa ──────────────────────────────────────
Route::middleware('role:siswa')->group(function () {
    Route::post('/api/payment/{transactionId}/snap-token', [\App\Http\Controllers\PaymentController::class, 'createSnapToken']);
    Route::post('/api/payment/{transactionId}/refund', [\App\Http\Controllers\RefundController::class, 'requestRefund'])->middleware('throttle:5,1');
    Route::post('/api/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->middleware('throttle:30,1');
    Route::get('/api/tasks/{id}/quiz', [\App\Http\Controllers\TaskController::class, 'getQuiz']);
    Route::post('/api/tasks/{id}/submit', [\App\Http\Controllers\TaskController::class, 'submitQuiz'])->middleware('throttle:30,1');
    Route::get('/api/classes/{id}/materials', [\App\Http\Controllers\MaterialController::class, 'getClassMaterials']);
    Route::get('/api/transactions/student', [\App\Http\Controllers\TransactionController::class, 'getStudentTransactions']);
    
    // Pairing routes for student
    Route::get('/api/pairing/token', [\App\Http\Controllers\ParentStudentPairingController::class, 'getToken']);
    Route::post('/api/pairing/token', [\App\Http\Controllers\ParentStudentPairingController::class, 'generateToken']);
});

// ── API khusus Orang Tua ──────────────────────────────────
Route::middleware('role:orangtua')->group(function () {
    Route::get('/api/pairing/children', [\App\Http\Controllers\ParentStudentPairingController::class, 'getChildren']);
    Route::post('/api/pairing/pair', [\App\Http\Controllers\ParentStudentPairingController::class, 'pair']);
});

// ── API khusus Tutor ──────────────────────────────────────
Route::middleware('role:tutor')->group(function () {
    Route::post('/api/tasks/{id}/questions', [\App\Http\Controllers\TaskController::class, 'createQuestion'])->middleware('throttle:30,1');
    Route::get('/api/transactions/tutor', [\App\Http\Controllers\TransactionController::class, 'getTutorEarnings']);
    
    // Availability routes
    Route::get('/api/tutor/availabilities', [\App\Http\Controllers\TutorAvailabilityController::class, 'index']);
    Route::post('/api/tutor/availabilities', [\App\Http\Controllers\TutorAvailabilityController::class, 'store']);
    Route::delete('/api/tutor/availabilities/{id}', [\App\Http\Controllers\TutorAvailabilityController::class, 'destroy']);
    Route::post('/api/tutor/availabilities/sync', [\App\Http\Controllers\TutorAvailabilityController::class, 'sync']);
});

});

// ── Midtrans Webhook (di LUAR auth middleware — server-to-server) ─────
Route::post('/api/midtrans/webhook', [\App\Http\Controllers\PaymentController::class, 'handleWebhook'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
