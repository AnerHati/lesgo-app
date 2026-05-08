<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\StudyClass;
use App\Models\TaskSubmission;

class ParentDashboardController extends Controller
{
    /**
     * Display the parent dashboard view.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil data anak-anak yang terhubung dengan akun Orang Tua ini
        $children = $user->children()->with('studentProfile')->get();

        $classes = collect([]);
        $recentScores = collect([]);

        // 2. Jika ada anak yang terhubung, ambil kelas aktif dan tugas terbarunya
        if ($children->isNotEmpty()) {
            $activeChild = $children->first(); // Mengambil data anak pertama

            $classes = StudyClass::where('student_id', $activeChild->id)
                        ->with(['subject', 'tutor'])
                        ->get();

            // Mengambil 5 nilai kuis terbaru anak tersebut
            $recentScores = TaskSubmission::where('student_id', $activeChild->id)
                        ->with('task')
                        ->latest()
                        ->take(5)
                        ->get();
        }

        return Inertia::render('Dashboard/Parent/Index', [
            'auth' => [
                'user' => $user
            ],
            // Data ini dikirim ke frontend Vue
            'children' => $children,
            'activeClasses' => $classes,
            'recentScores' => $recentScores
        ]);
    }
}
