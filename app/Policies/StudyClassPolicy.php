<?php

namespace App\Policies;

use App\Models\StudyClass;
use App\Models\User;

class StudyClassPolicy
{
    // Hanya tutor pemilik kelas yang berhak mengelola (manage)
    public function manage(User $user, StudyClass $studyClass): bool
    {
        return $user->id === $studyClass->tutor_id;
    }
}
