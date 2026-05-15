<?php

namespace App\Http\Controllers;

use App\Models\StudyClass;
use App\Services\MaterialService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Material;

class MaterialController extends Controller
{
    public function __construct(private readonly MaterialService $materialService)
    {
    }

    public function store(Request $request, StudyClass $studyClass): JsonResponse
    {
        // Security Check: Hanya tutor pemilik kelas yang bisa menambah materi
        \Illuminate\Support\Facades\Gate::authorize('manage', $studyClass);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order_index' => ['nullable', 'integer', 'min:1'],
            'status' => ['nullable', 'in:locked,completed,active'],
            'task_templates' => ['nullable', 'array', 'min:1'],
            'task_templates.*.title' => ['required_with:task_templates', 'string', 'max:255'],
            'task_templates.*.description' => ['nullable', 'string'],
            'task_templates.*.status' => ['nullable', 'in:pending,done,late'],
            'task_templates.*.deadline' => ['nullable', 'date'],
        ]);

        $material = $this->materialService->createMaterialWithDefaultTasks($studyClass, $validated);

        return response()->json([
            'message' => 'Materi berhasil dibuat beserta tugas default.',
            'data' => $material,
        ], 201);
    }

    

    public function getClassMaterials($classId)
    {
        $studyClass = StudyClass::findOrFail($classId);
        
        // Security Check: Hanya siswa atau tutor di kelas tersebut yang bisa melihat materi
        if ($studyClass->student_id !== Auth::id() && $studyClass->tutor_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke materi kelas ini.');
        }

        // Ambil materi yang diurutkan berdasarkan order_index
        $materials = Material::where('study_class_id', $studyClass->id)
            ->with('tasks') // Load juga tugas yang terhubung ke materi ini
            ->orderBy('order_index', 'asc')
            ->get();
        return response()->json([
            'class' => [
                'id' => $studyClass->id,
                'subject' => $studyClass->subject->name ?? 'Mata Pelajaran',
                'topic' => $studyClass->paket_mengajar,
                'tutor' => $studyClass->tutor->name ?? 'Tutor',
                'icon' => $studyClass->subject->icon ?? '📚',
            ],
            'materials' => $materials
        ]);
    
    
   
}
}
