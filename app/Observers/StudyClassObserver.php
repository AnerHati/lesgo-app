<?php

namespace App\Observers;

use App\Models\StudyClass;
use App\Enums\StudyClassStatus;
use App\Services\GamificationService;

class StudyClassObserver
{
    protected $gamificationService;

    public function __construct(GamificationService $gamificationService)
    {
        $this->gamificationService = $gamificationService;
    }

    /**
     * Handle the StudyClass "updated" event.
     */
    public function updated(StudyClass $studyClass): void
    {
        if ($studyClass->isDirty('status') && $studyClass->status === StudyClassStatus::COMPLETED) {
            $student = $studyClass->student;
            if ($student) {
                $this->gamificationService->addPointsToUser(
                    $student, 
                    100
                );
            }
        }
    }
}
