<?php

namespace App\Http\Controllers;

use App\Models\StudyClass;
use App\Services\MaterialService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function __construct(private readonly MaterialService $materialService)
    {
    }

    public function store(Request $request, StudyClass $studyClass): JsonResponse
    {
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
}
