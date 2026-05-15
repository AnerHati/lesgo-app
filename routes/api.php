<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ParentStudentPairingController;
use App\Http\Controllers\TutorAvailabilityController;
use App\Http\Controllers\Api\TutorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// ── Public API (No Auth) ─────────────────────────────────────────────
Route::post('/midtrans/webhook', [PaymentController::class, 'handleWebhook']);

// ── Authenticated API (Requires Session/Auth) ────────────────────────
Route::middleware('auth')->group(function () {

    // Common API
    Route::get('/reviews/tutor/{tutorId}', [ReviewController::class, 'getTutorReviews']);
    Route::post('/attachments', [AttachmentController::class, 'upload'])->middleware('throttle:30,1');
    Route::get('/attachments/{id}/download', [AttachmentController::class, 'download'])->name('attachments.download');
    Route::delete('/attachments/{id}', [AttachmentController::class, 'delete']);

    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount']);
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead']);

    // Chat API (Siswa & Tutor)
    Route::middleware('role:siswa,tutor')->group(function () {
        Route::get('/chat/contacts', [MessageController::class, 'getContacts']);
        Route::get('/chat/messages/{contactId}', [MessageController::class, 'fetchMessages']);
        Route::post('/chat/messages', [MessageController::class, 'sendMessage'])->middleware('throttle:60,1');
    });

    // API khusus Siswa
    Route::middleware('role:siswa')->group(function () {
        Route::get('/gamification/leaderboard', [\App\Http\Controllers\Api\LeaderboardController::class, 'index']);
        Route::get('/tutors', [TutorController::class, 'index']);
        Route::post('/payment/{transactionId}/snap-token', [PaymentController::class, 'createSnapToken']);
        Route::post('/payment/{transactionId}/refund', [RefundController::class, 'requestRefund'])->middleware('throttle:5,1');
        Route::post('/reviews', [ReviewController::class, 'store'])->middleware('throttle:30,1');
        Route::get('/tasks/{id}/quiz', [TaskController::class, 'getQuiz']);
        Route::post('/tasks/{id}/submit', [TaskController::class, 'submitQuiz'])->middleware('throttle:30,1');
        Route::get('/classes/{id}/materials', [MaterialController::class, 'getClassMaterials']);
        Route::get('/transactions/student', [TransactionController::class, 'getStudentTransactions']);
        
        // Pairing routes
        Route::get('/pairing/token', [ParentStudentPairingController::class, 'getToken']);
        Route::post('/pairing/token', [ParentStudentPairingController::class, 'generateToken'])->middleware('throttle:5,1');
    });

    // API khusus Orang Tua
    Route::middleware('role:orangtua')->group(function () {
        Route::get('/pairing/children', [ParentStudentPairingController::class, 'getChildren']);
        Route::post('/pairing/pair', [ParentStudentPairingController::class, 'pair'])->middleware('throttle:5,1');
    });

    // API khusus Tutor
    Route::middleware('role:tutor')->group(function () {
        Route::get('/tutor/{tutorId}/availabilities', [TutorAvailabilityController::class, 'getByTutor']);
        Route::post('/tasks/{id}/questions', [TaskController::class, 'createQuestion'])->middleware('throttle:30,1');
        Route::get('/transactions/tutor', [TransactionController::class, 'getTutorEarnings']);
        
        // Availability routes
        Route::get('/availabilities', [TutorAvailabilityController::class, 'index']);
        Route::post('/availabilities', [TutorAvailabilityController::class, 'store']);
        Route::delete('/availabilities/{id}', [TutorAvailabilityController::class, 'destroy']);
        Route::post('/availabilities/sync', [TutorAvailabilityController::class, 'sync']);
    });

    // ── API Khusus Admin ──────────────────────────────────────
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::post('/refunds/{id}/approve', [\App\Http\Controllers\Admin\RefundController::class, 'approve']);
        Route::post('/refunds/{id}/reject', [\App\Http\Controllers\Admin\RefundController::class, 'reject']);
    });
});
