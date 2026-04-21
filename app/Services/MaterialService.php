<?php

namespace App\Services;

use App\Models\Material;
use App\Models\StudyClass;
use Illuminate\Support\Facades\DB;

class MaterialService
{
    /**
     * Create a new material and auto-generate default tasks.
     *
     * @param  array<string, mixed>  $payload
     */
    public function createMaterialWithDefaultTasks(StudyClass $studyClass, array $payload): Material
    {
        return DB::transaction(function () use ($studyClass, $payload) {
            $nextOrder = (int) $studyClass->materials()->max('order_index') + 1;

            $material = $studyClass->materials()->create([
                'title' => $payload['title'],
                'description' => $payload['description'] ?? null,
                'order_index' => $payload['order_index'] ?? $nextOrder,
                'status' => $payload['status'] ?? 'locked',
            ]);

            $taskTemplates = $payload['task_templates'] ?? $this->defaultTaskTemplates($material->title);

            foreach ($taskTemplates as $template) {
                $material->tasks()->create([
                    'title' => $template['title'],
                    'description' => $template['description'] ?? null,
                    'status' => $template['status'] ?? 'pending',
                    'deadline' => $template['deadline'] ?? null,
                ]);
            }

            return $material->load('tasks');
        });
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function defaultTaskTemplates(string $materialTitle): array
    {
        return [
            [
                'title' => "Tugas 1: Menulis {$materialTitle} A-Ka",
                'description' => "Tulislah di buku tulis, {$materialTitle} A-Ka",
                'status' => 'pending',
            ],
            [
                'title' => "Tugas 2: Menulis {$materialTitle} A-Sa",
                'description' => "Tulislah di buku tulis, {$materialTitle} A-Sa",
                'status' => 'pending',
            ],
            [
                'title' => "Tugas 3: Quiz {$materialTitle}",
                'description' => "Kerjakan quiz singkat pengenalan {$materialTitle}",
                'status' => 'pending',
            ],
        ];
    }
}
