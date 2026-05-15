<?php

namespace App\Policies;

use App\Models\Material;
use App\Models\User;

class MaterialPolicy
{
    /**
     * Determine whether the user can view or manage the material.
     */
    public function view(User $user, Material $material): bool
    {
        return $user->id === $material->studyClass->student_id || 
               $user->id === $material->studyClass->tutor_id;
    }

    /**
     * Determine whether the user can create materials for the class.
     */
    public function manage(User $user, Material $material): bool
    {
        return $user->id === $material->studyClass->tutor_id;
    }
}
