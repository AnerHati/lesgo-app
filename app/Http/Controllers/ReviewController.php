<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\StudyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\StudyClassStatus;

class ReviewController extends Controller
{
    protected $gamificationService;

    public function __construct(\App\Services\GamificationService $gamificationService)
    {
        $this->gamificationService = $gamificationService;
    }

    // Siswa submit review setelah kelas selesai
    public function store(Request $request)
    {
        $request->validate([
            'study_class_id' => 'required|exists:study_classes,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $studyClass = StudyClass::findOrFail($request->study_class_id);

        // Pastikan user adalah siswa di kelas ini
        if ($studyClass->student_id !== Auth::id()) {
            abort(403, 'Anda bukan siswa di kelas ini.');
        }

        // Pastikan kelas sudah selesai atau aktif
        if (!in_array($studyClass->status, [StudyClassStatus::ACTIVE, StudyClassStatus::COMPLETED])) {
            abort(403, 'Kelas belum bisa di-review.');
        }

        // Cek apakah ini review pertama siswa
        $isFirstReview = Review::where('student_id', Auth::id())->count() === 0;

        $review = Review::create([
            'study_class_id' => $studyClass->id,
            'student_id' => Auth::id(),
            'tutor_id' => $studyClass->tutor_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // ── Gamifikasi: Berikan Poin ──
        if ($isFirstReview) {
            // Berikan +100 poin untuk review pertama
            $this->gamificationService->addPointsToUser(Auth::user(), 100);
        } else {
            // Berikan +20 poin untuk review reguler
            $this->gamificationService->addPointsToUser(Auth::user(), 20);
        }

        return response()->json([
            'message' => 'Review berhasil dikirim!',
            'review' => $review,
        ], 201);
    }

    // Ambil semua review untuk tutor tertentu
    public function getTutorReviews($tutorId)
    {
        $reviews = Review::where('tutor_id', $tutorId)
            ->where('is_visible', true)
            ->with('student:id,name')
            ->latest()
            ->get();

        return response()->json($reviews);
    }
}
