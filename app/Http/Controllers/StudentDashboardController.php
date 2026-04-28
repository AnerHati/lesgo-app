<?php

namespace App\Http\Controllers;

use App\Models\StudyClass;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use Inertia\Response;

class StudentDashboardController extends Controller
{
    public function __invoke(): Response
    {
        // Prevent login/dashboard crash when new tables are not migrated yet.
        if (! Schema::hasTable('study_classes')) {
            return Inertia::render('Dashboard/Student/Index', [
                'japaneseClassData' => null,
            ]);
        }

        $japaneseClass = StudyClass::query()
            ->where('name', 'Bahasa Jepang')
            ->with([
                'materials' => fn ($query) => $query
                    ->orderBy('order_index')
                    ->with('tasks'),
            ])
            ->first();

        return Inertia::render('Dashboard/Student/Index', [
            'japaneseClassData' => $japaneseClass,
        ]);
    }
}
