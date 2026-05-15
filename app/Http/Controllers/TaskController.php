<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\TaskAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\GamificationService;

class TaskController extends Controller
{
    protected $gamificationService;

    public function __construct(GamificationService $gamificationService)
    {
        $this->gamificationService = $gamificationService;
    }

    /**
     * Mengambil data soal beserta pilihan gandanya (untuk di-render di Vue)
     */
    public function getQuiz($id)
    {
        // Kita load relasi questions dan options
        $task = Task::with(['questions.options' => function($query) {
            // Jangan bawa 'is_correct' ke frontend agar kunci jawaban tidak bocor!
            $query->select('id', 'task_question_id', 'label', 'value');
        }])->findOrFail($id);

        // Security Check: Pastikan hanya siswa pemilik kelas yang bisa akses
        \Illuminate\Support\Facades\Gate::authorize('accessAsStudent', $task->studyClass);

        return response()->json([
            'task' => $task,
            'questions' => $task->questions
        ]);
    }

    /**
     * Memproses jawaban yang di-submit siswa dan menghitung skor otomatis
     */
    public function submitQuiz(Request $request, $id)
    {
        $request->validate([
            // Memastikan frontend mengirim array jawaban (format: [ question_id => option_id ])
            'answers' => 'required|array', 
        ]);

        $task = Task::with('questions.options')->findOrFail($id);

        // Security Check: Pastikan hanya siswa pemilik kelas yang bisa submit
        \Illuminate\Support\Facades\Gate::authorize('accessAsStudent', $task->studyClass);

        $studentId = Auth::id();

        // 1. Cek apakah siswa sudah pernah mengerjakan
        $existingSubmission = TaskSubmission::where('task_id', $task->id)
            ->where('student_id', $studentId)
            ->first();

        if ($existingSubmission) {
            return response()->json(['message' => 'Anda sudah mengerjakan kuis ini sebelumnya.'], 403);
        }

        // 2. Siapkan kalkulasi
        $totalQuestions = $task->questions->count();
        $correctAnswers = 0;

        // Buat record submission awal
        $submission = TaskSubmission::create([
            'task_id' => $task->id,
            'student_id' => $studentId,
            'score' => 0, // Skor sementara 0
            'submitted_at' => now(),
        ]);

        // 3. Periksa setiap jawaban
        foreach ($request->answers as $questionId => $optionId) {
            $question = $task->questions->where('id', $questionId)->first();
            if ($question) {
                // Cari opsi yang dipilih
                $option = $question->options->where('id', $optionId)->first();
                
                // Jika is_correct == true, tambah point
                if ($option && $option->is_correct) {
                    $correctAnswers++;
                }

                // Rekam jawaban siswa per soal
                TaskAnswer::create([
                    'task_submission_id' => $submission->id,
                    'task_question_id' => $questionId,
                    'task_option_id' => $optionId,
                ]);
            }
        }

        // 4. Kalkulasi nilai akhir (skala 100)
        $score = 0;
        if ($totalQuestions > 0) {
            $score = (int) round(($correctAnswers / $totalQuestions) * 100);
        }

        // Update skor di database
        $submission->update(['score' => $score]);
        
        // ── Gamifikasi: Berikan Poin Dinamis ──
        // Rumus: 10 (base points) + (score / 2)
        // Jadi jika skor 100 -> dapat 60 poin. Jika skor 0 -> dapat 10 poin (reward usaha).
        $earnedPoints = 10 + (int)($score / 2);
        $this->gamificationService->addPointsToUser(Auth::user(), $earnedPoints);

        // Update status di table tasks (jika perlu)
        $task->update(['status' => 'submitted']);

        return response()->json([
            'message' => 'Kuis berhasil diselesaikan!',
            'score' => $score,
            'correct_answers' => $correctAnswers,
            'total_questions' => $totalQuestions
        ]);
    }

    /**
     * Menyimpan soal kuis baru beserta pilihan ganda yang dibuat oleh Tutor
     */
    public function createQuestion(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'type' => 'required|string|in:multiple_choice,essay',
            // Pastikan tutor mengirim minimal 2 pilihan jawaban (misal A dan B)
            'options' => 'required|array|min:2', 
            'options.*.label' => 'required|string', // A, B, C, D
            'options.*.value' => 'required|string', // Teks jawaban (misal: "Tokyo")
            'options.*.is_correct' => 'required|boolean' // Mana yang benar
        ]);

        $task = Task::findOrFail($id);

        // Security Check: Gunakan Policy untuk memastikan tutor adalah pemilik kelas
        \Illuminate\Support\Facades\Gate::authorize('manage', $task->studyClass);

        // 1. Simpan Pertanyaan
        $taskQuestion = \App\Models\TaskQuestion::create([
            'task_id' => $task->id,
            'question' => $request->question,
            'type' => $request->type
        ]);

        // 2. Simpan Opsi Jawaban (A,B,C,D) yang terhubung dengan pertanyaan di atas
        foreach ($request->options as $opt) {
            \App\Models\TaskOption::create([
                'task_question_id' => $taskQuestion->id,
                'label' => $opt['label'],
                'value' => $opt['value'],
                'is_correct' => $opt['is_correct']
            ]);
        }

        return response()->json([
            'message' => 'Soal berhasil ditambahkan ke dalam Kuis!',
            'question' => $taskQuestion->load('options')
        ], 201);
    }
}
